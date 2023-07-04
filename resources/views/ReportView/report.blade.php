<x-app-layout>
    <div class="flex bg-white rounded-lg p-12 m-12">
        <div id="InventoryChart" style="height:400px;" class="relative w-full"></div>
    </div>
    <div class="flex bg-white rounded-lg p-12 m-12">
        <div id="ProfitChart" style="height:400px;" class="relative w-full"></div>
    </div>
</x-app-layout>

<script>
    window.onload = function () {
        CanvasJS.addColorSet("orangeShades",
        [//colorSet Array
            "#F59E0B", 
            "#DB7E12", 
            "#AD6918",         
        ]);
    
    var InventoryChart = new CanvasJS.Chart("InventoryChart", {
        colorSet: "orangeShades", 
        animationEnabled: true,
        theme: "light1", // "light1", "light2", "dark1", "dark2"
        title:{
            text: "Inventory"
        },
        axisY: {
            title: "Item Quantity"
        },
        axisX: {
            title: "Item"
        }, 
        data: [{        
            type: "column",  
            dataPoints: <?php echo JSON_encode($item_data, JSON_NUMERIC_CHECK); ?>
        }]
    });

    var ProfitChart = new CanvasJS.Chart("ProfitChart", {
        colorSet: "orangeShades", 
        animationEnabled: true,
        theme: "light1", // "light1", "light2", "dark1", "dark2"
        title:{
            text: "Profit"
        },
        axisY: {
            title: "Profit (RM)"
        },
        axisX: {
            title: "Month"
        }, 
        data: [{        
            type: "column",  
            dataPoints: <?php echo JSON_encode($profit_data, JSON_NUMERIC_CHECK); ?>
        }]
    });

    InventoryChart.render();
    ProfitChart.render();
    }
</script>

