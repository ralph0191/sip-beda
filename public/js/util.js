
const uiBlockerLoader=()=> {
    $.blockUI({
        zIndex: 20000,
        baseZ: 2000,
        css: {
            backgroundColor: 'transparent',
            border: 'none',
        },
        message: uiBlockerHtml(),
    });
}

/**
 * UI BLOCKER DIV
 */
const uiBlockerHtml=()=> {
    const arrayHtml = [];
    arrayHtml.push(

    // '<div class="loading-screen">' +
    //     '<div class="row">' + 
    //         '<div class="col-md-12">' + 
    //             '<div class="lds-roller">' +
    //                 '<div class="lds-heart">'+
    //                     '<div></div>' + 
    //                 '</div>' + 
    //             '</div>' + 
    //         '</div>' +
    //         '<div class="row top-20px">' +
    //             '<div class="col-md-12">' +
    //                 // '<p>Please Wait...</p>' + 
    //             '</div>' +
    //         '</div>'+
    //     '</div>' +
    // '</div>'

    // '<div class="pre_loader">'+
    //     '<img src="../images/uiblocker_bars.gif">'+
    // '</div>'

    '<div class="lds-ring">'+
        '<div></div><div></div><div></div><div></div>'+
    '</div>'

    );

    return arrayHtml[0];
}

/**
 * Description: Redirects user to the given url
 * @param url
 * @returns
 */
function redirect(url,noOfSeconds) {
	setTimeout(function() {$(location).attr("href", url);},noOfSeconds)
}

/**
 *  Preview Photo
 * 
 * @param {file} file = file uploaded 
 * @param {string} dom = id of field where the picture display/preview
 */
const previewFile = (file,dom) => {
  if (file.files && file.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      $('#'+dom).attr('src', e.target.result);
      $('#'+dom).hide();
      $('#'+dom).fadeIn(650);
    }
    reader.readAsDataURL(file.files[0]);
  }
}


/**
 * Check field is empty
 * 
 * @param {*} dom 
 */
const isEmptyField=(dom)=> {
    return (dom);
}

/**
 * Check array list is empty
 * 
 * @param {*} arrayList 
 */
const isEmptyArray=(arrayList)=> {
    return (arrayList.length != 0);
}

/**
 * Delay a process or block in the middle of process for n MS. 
 * Useful when ajax function is included inside window.beforeunload and window.onbeforeunload
 * @param {string} delay - millisecond
 * 
 */
const sleep = (delay) => {
    var start = new Date().getTime();
    while (new Date().getTime() < start + delay);
}

function delay(callback, ms) {
    var timer = 0;
    
    return function() {
      var context = this, args = arguments;
      clearTimeout(timer);

      timer = setTimeout(function () {
        callback.apply(context, args);
      }, ms || 0);
    };
  }