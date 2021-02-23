$(document).ready(function() {
  initPreInternshipChart();
  initDuringInternshipChart();
  initEndInternshipChart();
});

const initPreInternshipChart=()=> {
  var options;
  $.when(ajax.fetch('/student/pre-internship/chart')).done(function(response) {
    let data = response.data;
    let dataArray = [];

    dataArray.push(parseInt(data[0].completed));
    dataArray.push(parseInt(data[0].not_completed));

    switch(response.status) {
      case HttpStatus.SUCCESS:
        if (response.data[0] != null) {
          options = {
            chart: {
              type: 'donut'
            },
            series: dataArray,
            labels: ["Passed Requirements", "Remaining Requirments"],
            fill: {
              colors: ['#008000', '#696969']
            },
          };
          var chart = new ApexCharts(document.querySelector("#pre-internship-pie"), options);
            
          chart.render();
        } else {
          options = {
            chart: {
              type: 'donut'
            },
            series: [0, 100],
            labels: ["Passed Requirements", "Remaining Requirments"],
            fill: {
              colors: ['#008000', '#696969']
            } 
          };
          var chart = new ApexCharts(document.querySelector("#pre-internship-pie"), options);
            
          chart.render();
        }
        break;  
    }
  });
}

const initDuringInternshipChart=()=> {
  var options;
  $.when(ajax.fetch('/student/during-internship/chart')).done(function(response) {
    let data = response.data;
    let dataArray = [];

    dataArray.push(parseInt(data[0].completed));
    dataArray.push(parseInt(data[0].not_completed));

    switch(response.status) {
      case HttpStatus.SUCCESS:
        if (response.data[0] != null) {
          options = {
            chart: {
              type: 'donut'
            },
            series: dataArray,
            labels: ["Passed Requirements", "Remaining Requirments"],
            fill: {
              colors: ['#008000', '#696969']
            },
          };
          var chart = new ApexCharts(document.querySelector("#during-internship-pie"), options);
            
          chart.render();
        } else {
          options = {
            chart: {
              type: 'donut'
            },
            series: [0, 100],
            labels: ["Passed Requirements", "Remaining Requirments"],
            fill: {
              colors: ['#008000', '#696969']
            } 
          };
          var chart = new ApexCharts(document.querySelector("#during-internship-pie"), options);
            
          chart.render();
        }
        break;  
    }
  });
}

const initEndInternshipChart=()=> {
  var options;
  
  $.when(ajax.fetch('/student/end-internship/chart')).done(function(response) {
    let data = response.data;
    let dataArray = [];
    dataArray.push(parseInt(data[0].not_submitted));
    dataArray.push(parseInt(data[0].pending));
    dataArray.push(parseInt(data[0].submitted));

    switch(response.status) {
      case HttpStatus.SUCCESS:
        if (response.data[0] != null) {
          options = {
            chart: {
              type: 'donut'
            },
            series: dataArray,
            labels: ["Passed Requirements", "Remaining Requirments"],
            fill: {
              colors: ['#008000', '#696969']
            },
          };
          var chart = new ApexCharts(document.querySelector("#end-internship-pie"), options);
            
          chart.render();
        } else {
          options = {
            chart: {
              type: 'donut'
            },
            series: [0, 100],
            labels: ["Passed Requirements", "Remaining Requirments"],
            fill: {
              colors: ['#008000', '#696969']
            } 
          };
          var chart = new ApexCharts(document.querySelector("#end-internship-pie"), options);
            
          chart.render();
        }
        break;  
    }
  });
}
