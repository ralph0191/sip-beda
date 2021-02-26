$(document).ready(function() {
    initPreInternshipChart();
    initDuringInternshipChart();
    initEndInternshipChart();
    initCoursesDropDown();
    initAttachListenerDropdown();
  });

  const initAttachListenerDropdown = () => {
    $(document).on("change", "#course",function(e) {
        e.preventDefault();
        uiBlockerLoader();
        $('#end-sip-filtered-pie').empty();
        $('#pre-sip-filtered-pie').empty();
        $('#during-sip-filtered-pie').empty();
        displayFilteredEndInternshipChart();
        displayFilteredDuringInternshipChart();
        displayFilteredPreInternshipChart();
        $.unblockUI();

    });
}
  
  const initCoursesDropDown=()=> {
    $.when(ajax.fetch('/courses')).done(function(response) {
        
        switch(response.status) {
           
            case HttpStatus.SUCCESS:
                let courses = response.course;
                for (i = 0; i < courses.length; i++) {
                    $("#course").append($("<option/>").attr("value", courses[i].id).html(courses[i].name));
                }
                $("#course").trigger("contentChanged");
            break;  
        }
    });
}

const initPreInternshipChart=()=> {
    var options;
    $.when(ajax.fetch('/sip/pre-internship-all/chart')).done(function(response) {
        let data = response.data;
        let dataArray = [];

        dataArray.push(parseInt(data[0].not_started));
        dataArray.push(parseInt(data[0].ongoing));
        dataArray.push(parseInt(data[0].finished));

        switch(response.status) {
            case HttpStatus.SUCCESS:
                if (response.data[0] != null) {
                options = {
                    chart: {
                    type: 'donut'
                    },
                    series: dataArray,
                    labels: ["Not Started", "Ongoing", "Finished"],
                    colors: ['#696969', '#ffa500', '#008000']
                };
                var chart = new ApexCharts(document.querySelector("#pre-sip-all-pie"), options);
                    
                chart.render();
                } else {
                    options = {
                        chart: {
                            type: 'donut'
                        },
                        series: [0, 0, 0],
                        labels: ["Not Started", "Ongoing", "Finished"],
                        colors: ['#696969', '#ffa500', '#008000']
                        
                    };
                    var chart = new ApexCharts(document.querySelector("#pre-sip-all-pie"), options);
                        
                    chart.render();
                }
            break;  
        }
    });
}
  
const initDuringInternshipChart=()=> {
    var options;
    $.when(ajax.fetch('/sip/during-internship-all/chart')).done(function(response) {
        let data = response.data;
        let dataArray = [];

        dataArray.push(parseInt(data[0].not_started));
        dataArray.push(parseInt(data[0].ongoing));
        dataArray.push(parseInt(data[0].finished));

        switch(response.status) {
            case HttpStatus.SUCCESS:
                if (response.data[0] != null) {
                    options = {
                        chart: {
                        type: 'donut'
                        },
                        series: dataArray,
                        labels: ["Not Started", "Ongoing", "Finished"],
                        colors: ['#696969', '#ffa500', '#008000']
                    };
                    var chart = new ApexCharts(document.querySelector("#during-sip-all-pie"), options);
                    
                    chart.render();
                } else {
                    options = {
                        chart: {
                        type: 'donut'
                        },
                        series: [0, 100],
                        labels: ["Not Started", "Ongoing", "Finished"],
                        colors: ['#696969', '#ffa500', '#008000']
                    };
                    var chart = new ApexCharts(document.querySelector("#during-sip-all-pie"), options);
                        
                    chart.render();
                }
            break;  
        }
    });
}
  
const initEndInternshipChart=()=> {
    var options;

    $.when(ajax.fetch('/sip/end-internship-all/chart')).done(function(response) {
        let data = response.data;
        let dataArray = [];
        dataArray.push(parseInt(data[0].not_started));
        dataArray.push(parseInt(data[0].ongoing));
        dataArray.push(parseInt(data[0].finished));

        switch(response.status) {
        
            case HttpStatus.SUCCESS:
                if (response.data[0] != null) {
                    options = {
                        chart: {
                            type: 'donut'
                        },
                        series: dataArray,
                        labels: ["Not Started", "Ongoing", "Finished"],
                        colors: ['#696969', '#ffa500', '#008000']
                    };
                    var chart = new ApexCharts(document.querySelector("#end-sip-all-pie"), options);
                        
                    chart.render();
                } else {
                    options = {
                        chart: {
                            type: 'donut'
                        },
                        series: [0, 0,0],
                        labels: ["Not Started", "Ongoing", "Finished"],
                        colors: ['#696969', '#ffa500', '#008000']
                    };
                    var chart = new ApexCharts(document.querySelector("#end-sip-all-pie"), options);
                        
                    chart.render();
                }
            break;  
        }
    });
}

const displayFilteredPreInternshipChart=()=> {
    var options;
    let courseId = $('#course').val();

    $.when(ajax.fetch('/sip/pre-internship-filtered/chart/' + courseId)).done(function(response) {
        let data = response.data;
        let dataArray = [];

        dataArray.push(parseInt(data[0].not_started));
        dataArray.push(parseInt(data[0].ongoing));
        dataArray.push(parseInt(data[0].finished));

        switch(response.status) {
            case HttpStatus.SUCCESS:
                if (response.data[0] != null) {
                    options = {
                        chart: {
                            type: 'donut'
                        },
                        series: dataArray,
                        labels: ["Not Started", "Ongoing", "Finished"],
                        colors: ['#696969', '#ffa500', '#008000']
                    };
                var chart = new ApexCharts(document.querySelector("#pre-sip-filtered-pie"), options);
                    
                chart.render();
                } else {
                options = {
                    chart: {
                        type: 'donut'
                    },
                    series: [0, 0, 0],
                    labels: ["Not Started", "Ongoing", "Finished"],
                    colors: ['#696969', '#ffa500', '#008000']
                };
                var chart = new ApexCharts(document.querySelector("#pre-sip-filtered-pie"), options);
                    
                chart.render();
                }
            break;  
        }
    });
}
  
const displayFilteredDuringInternshipChart=()=> {
    var options;
    let courseId = $('#course').val();

    $.when(ajax.fetch('/sip/during-internship-filtered/chart/' + courseId)).done(function(response) {
        let data = response.data;
        let dataArray = [];

        dataArray.push(parseInt(data[0].not_started));
        dataArray.push(parseInt(data[0].ongoing));
        dataArray.push(parseInt(data[0].finished));

        switch(response.status) {
            case HttpStatus.SUCCESS:
                if (response.data[0] != null) {
                    options = {
                        chart: {
                            type: 'donut'
                        },
                        series: dataArray,
                        labels: ["Not Started", "Ongoing", "Finished"],
                        colors: ['#696969', '#ffa500', '#008000']
                    };
                    var chart = new ApexCharts(document.querySelector("#during-sip-filtered-pie"), options);
                        
                    chart.render();
                } else {
                    options = {
                        chart: {
                            type: 'donut'
                        },
                        series: [0, 100],
                        labels: ["Not Started", "Ongoing", "Finished"],
                        colors: ['#696969', '#ffa500', '#008000']
                    };
                    var chart = new ApexCharts(document.querySelector("#during-sip-filtered-pie"), options);
                        
                    chart.render();
                }
            break;  
        }
    });
}
  
const displayFilteredEndInternshipChart=()=> {
    var options;

    let courseId = $('#course').val();

    $.when(ajax.fetch('/sip/end-internship-filtered/chart/' + courseId)).done(function(response) {
        let data = response.data;
        let dataArray = [];
        dataArray.push(parseInt(data[0].not_started));
        dataArray.push(parseInt(data[0].ongoing));
        dataArray.push(parseInt(data[0].finished));

        switch(response.status) {
            case HttpStatus.SUCCESS:
                if (response.data[0] != null) {
                    options = {
                        chart: {
                            type: 'donut'
                        },
                        series: dataArray,
                        labels: ["Not Started", "Ongoing", "Finished"],
                        colors: ['#696969', '#ffa500', '#008000']
                    };
                    var chart = new ApexCharts(document.querySelector("#end-sip-filtered-pie"), options);
                        
                    chart.render();
                } else {
                    options = {
                        chart: {
                            type: 'donut'
                        },
                        series: [0, 0,0],
                        labels: ["Not Started", "Ongoing", "Finished"],
                        colors: ['#696969', '#ffa500', '#008000']
                    };
                    var chart = new ApexCharts(document.querySelector("#end-sip-filtered-pie"), options);
                        
                    chart.render();
                }
            break;  
        }
    });
}
  