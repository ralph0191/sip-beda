$(document).ready(function() {
    initIntentFormsChart();
    initDuringInternshipChart();
    initEndInternshipChart();
});
  
const initIntentFormsChart=()=> {
    var options;
    
    $.when(ajax.fetch('/dept-chair/intent-forms/chart')).done(function(response) {
        let data = response.data;
        let dataArray = [];
            
        dataArray.push(parseInt(data[0].not_submitted));
        dataArray.push(parseInt(data[0].pending));
        dataArray.push(parseInt(data[0].approved));
  
        switch(response.status) {
            case HttpStatus.SUCCESS:
    
                if (response.data[0] != null) {
                    options = {
                        chart: {
                            type: 'donut'
                        },
                        series: dataArray,
                        labels: ["Haven\'t Submitted yet", 'Pending', 'Approved'],
                        fill: {
                            colors: ['#696969', '#ffa500', '#008000']
                        },
                    };
                    var chart = new ApexCharts(document.querySelector("#intent-form-pie"), options);
                    
                    chart.render();
                } else {
                    options = {
                        chart: {
                            type: 'donut'
                        },
                        series: [0, 100],
                        labels: ["Haven\'t Submitted yet", 'Pending', 'Approved'],
                        fill: {
                            colors: ['#008000', '#ffa500', '#696969']
                        } 
                    };
                    var chart = new ApexCharts(document.querySelector("#intent-form-pie"), options);
                    
                    chart.render();
                }
            break;  
        }
    });
}
  
const initDuringInternshipChart=()=> {
    var options;

    $.when(ajax.fetch('/dept-chair/during-internship/chart')).done(function(response) {
        let data = response.data;
        let dataArray = [];

        dataArray.push(parseInt(data[0].not_started));
        dataArray.push(parseInt(data[0].started));
        dataArray.push(parseInt(data[0].finished));
  
        switch(response.status) {
            case HttpStatus.SUCCESS:

            if (response.data[0] != null) {
                options = {
                chart: {
                    type: 'donut'
                },
                series: dataArray,
                labels: ["Not Started", "On-going", "Finished"],
                fill: {
                    colors: ['#696969', '#ffa500', '#008000']
                },
                };
                var chart = new ApexCharts(document.querySelector("#during-dept-pie"), options);
                
                chart.render();
            } else {
                options = {
                    chart: {
                        type: 'donut'
                    },
                    series: [0, 0,0],
                    labels: ["Not Started", "On-going", "Finished"],
                    fill: {
                        colors: ['#696969', '#ffa500', '#008000']
                    } 
                };
                var chart = new ApexCharts(document.querySelector("#during-dept-pie"), options);
                
                chart.render();
            }
            break;  
        }
    });
}
  
const initEndInternshipChart=()=> {
    var options;

    $.when(ajax.fetch('/dept-chair/end-internship/chart')).done(function(response) {
        let data = response.data;
        let dataArray = [];

        dataArray.push(parseInt(data[0].not_started));
        dataArray.push(parseInt(data[0].started));
        dataArray.push(parseInt(data[0].finished));
  
        switch(response.status) {
            case HttpStatus.SUCCESS:

            if (response.data[0] != null) {
                options = {
                chart: {
                    type: 'donut'
                },
                series: dataArray,
                labels: ["Not Started", "On-going", "Finished"],
                fill: {
                    colors: ['#696969', '#ffa500', '#008000']
                },
                };
                var chart = new ApexCharts(document.querySelector("#end-dept-pie"), options);
                
                chart.render();
            } else {
                options = {
                    chart: {
                        type: 'donut'
                    },
                    series: [0, 0,0],
                    labels: ["Not Started", "On-going", "Finished"],
                    fill: {
                        colors: ['#696969', '#ffa500', '#008000']
                    } 
                };
                var chart = new ApexCharts(document.querySelector("#end-dept-pie"), options);
                
                chart.render();
            }
            break;  
        }
    });
}