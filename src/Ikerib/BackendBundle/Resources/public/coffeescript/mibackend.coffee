$(document).ready ->
  $('.btnedit').click ->
    that = this
    todoid = $(this).data "todoid"
    url = Routing.generate("todo_update",
        id: todoid
      )
    $.ajax url,
      type: "POST"
      contentType: "application/json"

      success: (data) ->
        if data.completed == 0
          $('.toggle').checked = null
          $(that).parents("li").removeClass "completed"

        else

          $('.toggle').checked = "yes"
          $(that).parents("li").addClass "completed"


      error: (xhr, ajaxOptions, thrownError) ->
        alert xhr.status
        alert thrownError

