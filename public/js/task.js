var processing = false;

$(() => {

$(".task_remove").on("click", function() {
  if(processing) return;

  var check = confirm("[Warning] Delete the task?");
  if(!check) return;

  processing = true;
  var self = this;
  delTask(self)
    .then(() => {
      processing = false;
    });
});

});

///////////////
// functions //
///////////////

function delTask(self) {
  var panel = $(self).parent().parent();
  var id = $(panel).find(".id").text();
  var data = {id};

  return ajaxDelTask(data)
    .then(() => {
      location.reload();
    })
    .catch(error => {
      console.log(error);
    });
}

//////////
// ajax //
//////////

function ajaxDelTask(data) {
  return new Promise((resolve, reject) => {
    $.ajax({
      url: "/task/del",
      type: "POST",
      data,
      success: (data, status, xhr) => {
        resolve(data);
      },
      error: (res) => {
        reject(res.responseJSON);
      }
    });
  });
}
