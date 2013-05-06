$(document).ready ->

  allRemovableItems = 0

  refreshElementRemaining = ->
    allCompletedItems = $("li:not(.completed) ").length
    $('#elementsRemaining').html allCompletedItems

  refreshElementToDelete = ->
    @allRemovableItems = $(".completed").length
    $('#clear-completed ').html "Clear completed (" + allRemovableItems + ")"

  refreshElementRemaining()
  refreshElementToDelete()

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

        refreshElementRemaining()
        refreshElementToDelete()

      error: (xhr, ajaxOptions, thrownError) ->
        alert xhr.status
        alert thrownError


  $('#toggle-all').on "click", ->
    if allRemovableItems == 0
      $('.toggle').attr "checked", true
    else
      $('.toggle').attr "checked", false