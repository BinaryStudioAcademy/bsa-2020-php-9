<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Actions\{
    CreateStockAction,
    DeleteStockAction,
    GetChartDataAction,
};
use App\Actions\Requests\{
    CreateStockRequest,
    DeleteStockRequest,
    GetChartDataRequest,
};

class MarketController extends Controller
{
    private CreateStockAction $createStockAction;
    private GetChartDataAction $getChartDataAction;
    private DeleteStockAction $deleteStockAction;

    public function __construct(
        CreateStockAction $createStockAction,
        GetChartDataAction $getChartDataAction,
        DeleteStockAction $deleteStockAction
    ) {
        $this->createStockAction = $createStockAction;
        $this->getChartDataAction = $getChartDataAction;
        $this->deleteStockAction = $deleteStockAction;
    }

    public function createStock(Request $request)
    {
        $result = $this->createStockAction->execute(
            new CreateStockRequest(
                new \DateTime($request->start_date),
                floatval($request->price)
            )
        );

        return response()->json([
            "data" => $result->toArray()
        ], 201);
    }

    public function deleteStock(Request $request)
    {
        $result = $this->deleteStockAction->execute(
            new DeleteStockRequest($request->stockId)
        );

        return response()->json([
            "data" => $result->toArray()
        ], 204);
    }

    public function getChartData(Request $request)
    {
        $result = $this->getChartDataAction->execute(
            new GetChartDataRequest(
                new \DateTime('@' . $request->start_date),
                new \DateTime('@' . $request->end_date),
                intval($request->frequency),
            )
        );

        return response()->json([
            "data" => $result->toArray()
        ], 200);
    }
}
