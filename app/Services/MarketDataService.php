<?php

declare(strict_types=1);

namespace App\Services;

use App\Services\Exceptions\InvalidFrequencyException;
use App\Repositories\Contracts\StockRepository;
use App\Repositories\Criteria\PeriodCriteria;
use App\DTO\Collections\ChartDataCollection;
use Illuminate\Support\Collection;
use App\DTO\Values\ChartData;
use App\Entities\Stock;

class MarketDataService implements Contracts\MarketDataService
{
	private StockRepository $stockRepository;

	public function __construct(StockRepository $stockRepository)
	{
		$this->stockRepository = $stockRepository;
	}

	public function getChartData(\DateTime $startDate, \DateTime $endDate, int $frequency): ChartDataCollection
	{
		$this->assertFrequency($frequency);

		$data = $this->stockRepository->findByCriteria(
			new PeriodCriteria($startDate, $endDate)
		);

		if ($data->isEmpty()) {
			return new ChartDataCollection();
		}

		return $this->groupByFrequency($data, $frequency, $startDate)->reduce(
			fn(ChartDataCollection $collection, Collection $chunk) => $collection->add(
				$this->groupChartData($chunk)
			),
			new ChartDataCollection()
		);
	}

	private function groupByFrequency(Collection $items, int $frequency, \DateTime $startQueriedDate): Collection
	{
		$first = $items->first();
		$offset = $first->start_date->getTimestamp();
		$startTimestamp = max(
			$offset - ($offset % $frequency),
			$startQueriedDate->getTimestamp(),
		);

		return $items->reduce(function (Collection $chunks, Stock $item) use($frequency, $offset, $startTimestamp) {
			$position = count($chunks) - 1;
			$nextPosition = floor(($item->start_date->getTimestamp() - $startTimestamp) / $frequency);

			if ($nextPosition > $position) {
				$chunks->add(new ChartDataCollection());
			}

			$chunk = $chunks->last();
			$currentTimestamp = $startTimestamp + ($frequency * $nextPosition);

			$chunk->add(
				new ChartData(
					new \DateTime('@' . $currentTimestamp),
					$item->price,
				)
			);

			return $chunks;
		}, new Collection());
	}

	private function groupChartData(Collection $chunk): ChartData
	{
		$price = $chunk->avg(fn(ChartData $item) => $item->getPrice());
		$startDate = $chunk->first()->getDate();

		return new ChartData(
			$startDate,
			$price,
		);
	}

	private function assertFrequency(int $frequency)
	{
		if ($frequency <= 0) {
			throw new InvalidFrequencyException();
		}
	}
}
