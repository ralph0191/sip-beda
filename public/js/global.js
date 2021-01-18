$(function(){
    defineHttpStatus();
    defineStatus();
    defineMessages();
	defineAjaxRequest();
	definePagination();
});


function defineHttpStatus() {
	HttpStatus = {
        SUCCESS:									200,
		NO_CONTENT:                                 204,
		FOUND:										302,
		HTTP_NOT_ACCEPTABLE:						406,
		HTTP_CONFLICT:								409,
        UNKNOWN_STATUS:                             419,
        UNPROCESSABLE_ENTITY:                       422,
        INTERNAL_SERVER_ERROR:					    500
    };
}

function defineStatus() {
    Status = {
         PENDING:   		    0,
         COMPLETED: 		    1,
     
         APPROVAL:        		0,
         APPROVED:              1,
         DECLINED:              2,
     
         OFF:                   0,
		 ON:                    1,
		 
		 MALE:					1,
		 FEMALE:				2,

		 PHYSICAL_CLINIC:		1,
		 ONLINE:				2,

		 MAIN_SPECIALIZATION:	1,
		 SUB_SPECIALIZATION:	2,

		 ENROLLED_IN_ADMIN:		1,
		 ENROLLED_IN_REGISTER:	2,
	},
	
	Days = [
		{ DAY_NAME: 'Monday', 	 EQUIVALENT: 1  },
		{ DAY_NAME: 'Tuesday',   EQUIVALENT: 2  },
		{ DAY_NAME: 'Wednesday', EQUIVALENT: 3  },
		{ DAY_NAME: 'Thursday',  EQUIVALENT: 4  },
		{ DAY_NAME: 'Friday',    EQUIVALENT: 5  },
		{ DAY_NAME: 'Saturday',  EQUIVALENT: 6  },
		{ DAY_NAME: 'Sunday',    EQUIVALENT: 7  }
	]
}

function defineMessages() { 
	var tryAgainClause = "\n Please try again. \n If the problem persists, \n please contact info@mdirect.com.";
	
	Message = {
		UNKNOWN_STATUS:
        "An error has occurred \n" + tryAgainClause,	
        INTERNAL_SERVER_ERROR:
			"An error has occurred \n while connecting to the database. " + tryAgainClause,	
		UNHANDLED_ERROR_MESSAGE:
            "A server error has occurred. " + tryAgainClause,
        NO_CONTENT:
            "Please fill out required fields",
        UNPROCESSABLE_ENTITY:
            "Please fill out required fields",
        SUCCESS: 
            "Success!",
		SUCCESS_INSERT:
            "Success",
        SUCCESS_UPDATE:
            "Success",
        SUCCESS_DELETE:
            "Success"
	}
}

function defineAjaxRequest() {
	ajax = {
		/**
		 * Description: Generalized Ajax Request For List
		 * @Param url 
		 * @return
		 */	
		fetch : function(url) {
			return $.ajax({
				url: url,
				type: "GET",
				dataType: "json",
				contentType: "application/json",
				mimeType: "application/json",
				headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
			}).done(function(response) {
				switch(response.status) {
					case HttpStatus.SUCCESS:
						// alertify.success(Message.SUCCESS);
						break;
					case HttpStatus.INTERNAL_SERVER_ERROR:
						alertify.error(Message.INTERNAL_SERVER_ERROR);
						break;
				}
			});
		},
		/**
		 * Description: Generalized Ajax Request For Object
		 * @Param url
		 * @Param id
		 * @return
		 */
		fetchObj : function(url,id) {
			return $.ajax({
				url: url + id,
				type: "GET",
				dataType: "json",
				contentType: "application/json",
				mimeType: "application/json"
			}).done(function(response) {
				switch(response.status) {
					case HttpStatus.SUCCESS:
						// alertify.success(Message.SUCCESS);	
						break;
					case HttpStatus.INTERNAL_SERVER_ERROR:
						alertify.error(Message.INTERNAL_SERVER_ERROR);
						break;
				}
			});
		},
		fetchDateSchedule : function(url,date,dayName) {
			return $.ajax({
				url: url,
				type: "GET",
				data: {
					date:date,
					dayName:dayName
				},
				dataType: "json",
				contentType: "application/json",
				mimeType: "application/json",
				headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
			}).done(function(response) {
				switch(response.status) {
					case HttpStatus.SUCCESS:
						// alertify.error(Message.SUCCESS);
						break;
					case HttpStatus.INTERNAL_SERVER_ERROR:
						alertify.error(Message.INTERNAL_SERVER_ERROR);
						break;
					case HttpStatus.NO_CONTENT:
						alertify.warning(Message.NO_CONTENT);
						break;
				}
			});
		},
				/**
		 * Description: Generalized Ajax Request With Multiple Params
		 * @Param url
		 * @Param data
		 * @return
		 */
		fetchWithData : function(url,data) {
			return $.ajax({
				url: url,
				type: "GET",
				data: data,
				dataType: "json",
				contentType: "application/json",
				mimeType: "application/json"
			}).done(function(response) {
				switch(response.status) {
					case HttpStatus.SUCCESS:
						// alertify.success(Message.SUCCESS);
						break;
					case HttpStatus.INTERNAL_SERVER_ERROR:
						alertify.error(Message.INTERNAL_SERVER_ERROR);
						break;
					case HttpStatus.NO_CONTENT:
						alertify.warning(Message.NO_CONTENT);
						break;
				}
			});
		},
		update : function(url,id,data) {
			return $.ajax({
				url: url + id,
				type: "PUT",
				data: JSON.stringify(data),
				dataType: "json",
				contentType: "application/json",
				mimeType: "application/json",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
			}).done(function(response) {
				switch(response.status) {
					case HttpStatus.SUCCESS:
						alertify.success(Message.SUCCESS_UPDATE);
                        break;
                    case HttpStatus.NO_CONTENT:
                        alertify.warning(Message.NO_CONTENT);
                        break;
                    case HttpStatus.UNKNOWN_STATUS:
                        alertify.error(Message.UNKNOWN_STATUS);
                        break;
                    case HttpStatus.UNPROCESSABLE_ENTITY:
                        alertify.error(Message.UNPROCESSABLE_ENTITY);
                        break;
					case HttpStatus.INTERNAL_SERVER_ERROR:
						alertify.error(Message.INTERNAL_SERVER_ERROR);
						break;
				}
			});
		},

		updateWithoutData : function(url,id) {
			return $.ajax({
				url: url + id,
				type: "PUT",
				dataType: "json",
				contentType: "application/json",
				mimeType: "application/json",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
			}).done(function(response) {
				switch(response.status) {
					case HttpStatus.SUCCESS:
						alertify.success(Message.SUCCESS_UPDATE);
                        break;
                    case HttpStatus.NO_CONTENT:
                        alertify.warning(Message.NO_CONTENT);
                        break;
                    case HttpStatus.UNKNOWN_STATUS:
                        alertify.error(Message.UNKNOWN_STATUS);
                        break;
                    case HttpStatus.UNPROCESSABLE_ENTITY:
                        alertify.error(Message.UNPROCESSABLE_ENTITY);
                        break;
					case HttpStatus.INTERNAL_SERVER_ERROR:
						alertify.error(Message.INTERNAL_SERVER_ERROR);
						break;
				}
			});
		},
		customUpdate : function(url,data) {
			return $.ajax({
				url: url,
				type: "PUT",
				data: JSON.stringify(data),
				dataType: "json",
				contentType: "application/json",
				mimeType: "application/json",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
			}).done(function(response) {
				switch(response.status) {
					case HttpStatus.SUCCESS:
						$.unblockUI();
						alertify.success(Message.SUCCESS_UPDATE);
						break;
					case HttpStatus.NO_CONTENT:
						$.unblockUI();
						alertify.warning(Message.NO_CONTENT);
						break;
				}
			});
		},
		remove :function(url,id) {
			return $.ajax({
				url: url + id,
				type: "DELETE",
				dataType: "json",
				contentType: "application/json",
				mimeType: "application/json",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
			}).done(function(response) {
				switch(response.status) {
					case HttpStatus.SUCCESS:
						alertify.success(Message.SUCCESS_DELETE);
						break;
					case HttpStatus.INTERNAL_SERVER_ERROR:
						alertify.error(Message.INTERNAL_SERVER_ERROR);
						break;
				}
			});
		},
		customRemove : function(url,object) {
			return $.ajax({
				url: url,
				type: "DELETE",
				dataType: "json",
				data: JSON.stringify(object),
				contentType: "application/json",
                mimeType: "application/json",
				headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
			}).done(function(response) {
				switch(response.status) {
					case HttpStatus.SUCCESS:
						alertify.success(Message.SUCCESS_DELETE);
                        break;
                    case HttpStatus.NO_CONTENT:
                        alertify.warning(Message.NO_CONTENT);
                        break;
                    case HttpStatus.UNKNOWN_STATUS:
                        alertify.error(Message.UNKNOWN_STATUS);
                        break;
                    case HttpStatus.UNPROCESSABLE_ENTITY:
                        alertify.error(Message.UNPROCESSABLE_ENTITY);
                        break;
					case HttpStatus.INTERNAL_SERVER_ERROR:
						alertify.error(Message.INTERNAL_SERVER_ERROR);
						break;
				}
			});
		},
		search : function(url,object) {
			return $.ajax({
				url: url,
				type: "POST",
				dataType: "json",
				data: JSON.stringify(object),
				contentType: "application/json",
                mimeType: "application/json",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
			}).done(function(response) {
				switch(response.status) {
					case HttpStatus.SUCCESS:
						alertify.success(Message.SUCCESS);
                        break;
                    case HttpStatus.NO_CONTENT:
                        alertify.warning(Message.NO_CONTENT);
                        break;
                    case HttpStatus.UNKNOWN_STATUS:
                        alertify.error(Message.UNKNOWN_STATUS);
                        break;
                    case HttpStatus.UNPROCESSABLE_ENTITY:
                        alertify.error(Message.UNPROCESSABLE_ENTITY);
                        break;
					case HttpStatus.INTERNAL_SERVER_ERROR:
						alertify.error(Message.INTERNAL_SERVER_ERROR);
						break;
				}
			});
		},
		upload  : function(url,object) {
			return $.ajax({
				url: url,
				type: "POST",
				dataType: "json",
				data: JSON.stringify(object),
				mimeType: "application/json",
				enctype: 'multipart/form-data',
				processData: false,
		        contentType: false,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
			}).done(function(response) {
				switch(response.status) {
					case HttpStatus.SUCCESS:
						alertify.success(Message.SUCCESS_INSERT);
                        break;
                    case HttpStatus.NO_CONTENT:
                        alertify.warning(Message.NO_CONTENT);
                        break;
                    case HttpStatus.UNKNOWN_STATUS:
                        alertify.error(Message.UNKNOWN_STATUS);
                        break;
                    case HttpStatus.UNPROCESSABLE_ENTITY:
                        alertify.error(Message.UNPROCESSABLE_ENTITY);
                        break;
					case HttpStatus.INTERNAL_SERVER_ERROR:
						alertify.error(Message.INTERNAL_SERVER_ERROR);
						break;
				}
			});
		},
		create: function (url,data) {
			return $.ajax({
				type:'POST',
				url: url,
				data: JSON.stringify(data),
				dataType: "json",
				contentType: "application/json",
				mimeType: "application/json",
				headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
			}).done(function(response) {
				switch(response.status) {
					case HttpStatus.SUCCESS:
						alertify.success(Message.SUCCESS_INSERT);
						break;
					case HttpStatus.NO_CONTENT:
						alertify.warning(Message.NO_CONTENT);
						break;
					case HttpStatus.UNKNOWN_STATUS:
						alertify.error(Message.UNKNOWN_STATUS);
						break;
					case HttpStatus.UNPROCESSABLE_ENTITY:
						alertify.error(Message.UNPROCESSABLE_ENTITY);
						break;
					case HttpStatus.INTERNAL_SERVER_ERROR:
						alertify.error(Message.INTERNAL_SERVER_ERROR);
						break;
				}
			});
		},
		createWithFile: function (url,data) {
			return $.ajax({
				type:'POST',
				url: url,
				data: data,
				contentType: false,
				processData: false,
				headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
			}).done(function(response) {
				switch(response.status) {
					case HttpStatus.SUCCESS:
						alertify.success(Message.SUCCESS_INSERT);
						break;
					case HttpStatus.NO_CONTENT:
						alertify.warning(Message.NO_CONTENT);
						break;
					case HttpStatus.UNKNOWN_STATUS:
						alertify.error(Message.UNKNOWN_STATUS);
						break;
					case HttpStatus.UNPROCESSABLE_ENTITY:
						alertify.error(Message.UNPROCESSABLE_ENTITY);
						break;
					case HttpStatus.INTERNAL_SERVER_ERROR:
						alertify.error(Message.INTERNAL_SERVER_ERROR);
						break;
				}
			});
		},
		createAssistant: function (url,data) {
			return $.ajax({
				type:'POST',
				url: url,
				data: data,
				contentType: false,
				processData: false,
				headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
			}).done(function(response) {
				switch(response.status) {
					case HttpStatus.SUCCESS:
						alertify.success(Message.SUCCESS_INSERT);
						break;
					case HttpStatus.NO_CONTENT:
						alertify.warning(Message.NO_CONTENT);
						break;
					case HttpStatus.UNKNOWN_STATUS:
						alertify.error(Message.UNKNOWN_STATUS);
						break;
					case HttpStatus.UNPROCESSABLE_ENTITY:
						alertify.error(Message.UNPROCESSABLE_ENTITY);
						break;
					case HttpStatus.INTERNAL_SERVER_ERROR:
						alertify.error(Message.INTERNAL_SERVER_ERROR);
						break;
				}
			});
		}
	}
}

/**
 * Description: Initializes table pagination.
 * Response must include an integer named totalRecords.
 *
 * @param paginationProperties = {
 * 	paginationDom = e.g Id of pagination
 *  tableBodyDom = e.g Id of Table Body
 * 	url = ajax request url
 * 	locator = response data Source
 *  ajax = ajax request for searching of data
 *  className = custom class
 *  pageSize = desired page size
 *  functionName = method Name to be called when executed
 * }
 */
const definePagination=()=> {
	pagination = {
		/**
		 * Description: Initiates pagination table with no custom ajax request data
		 */
		initiate : function(paginationProperties) {
			$(paginationProperties.paginationDom).pagination({
		        dataSource: paginationProperties.url,
		        locator: paginationProperties.locator,
		        totalNumberLocator: function(response) {
		            return response.totalRecords;
		        },
		        ajax: paginationProperties.ajax,
		        className: paginationProperties.className,
		        pageSize: paginationProperties.pageSize,
		        callback: function(data) {
		            $(paginationProperties.tableBodyDom).html("");
		            globalList = data;
		            var functionName = eval()
		            _.each(data, function(object) {
		            	var functionName = paginationProperties.functionName + "(object)";
		            	eval(functionName);
		            });
		        }
		    });}
	}
}