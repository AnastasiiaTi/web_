(function () {
  // global variables
  let form = document.querySelector(".automatic-element-creation-form")

  // maximum amount of rows
  let maxRowCount = 8


  // defining functions
  let removeRow = (eventArgs) => {
    eventArgs.currentTarget.parentNode.parentNode.remove()
  }

  let moveRow = (eventArgs, up = true) => {
    if (form.querySelectorAll(".tab-list .tab-item").length < 2)
      return

    let currentRow = eventArgs.currentTarget.parentNode.parentNode
    let tabItemsContainer = form.querySelector(".tab-list")

    let isFirstChild = currentRow === tabItemsContainer.firstElementChild
    let isLastChild = currentRow === tabItemsContainer.lastElementChild

    if (up) {
      if (isFirstChild)
        return

      tabItemsContainer.insertBefore(currentRow, currentRow.previousElementSibling)
    } else {
      if (isLastChild)
        return

      let nextSibling = currentRow.nextElementSibling
      nextSibling.parentNode.insertBefore(currentRow, nextSibling.nextElementSibling)
    }
  }
  
  let addRow = () => {
    if (form.querySelectorAll(".tab-item").length > maxRowCount) {
      alert(`Maximum amount of rows (${maxRowCount}) exceded`)
      return
    }

    let template = document.querySelector("#tab-item-template")
    let newRow = document.importNode(template.content, true)

    // add event listeners
    newRow.querySelector(".remove span").addEventListener("click", removeRow)
    newRow.querySelector(".move .up").addEventListener("click", moveRow)
    newRow.querySelector(".move .down").addEventListener("click", (e) => moveRow(e, false))

    form.querySelector(".tab-list").appendChild(newRow)
  }


  // handle form submit
  let onFormSubmit = (eventArgs) => {
    eventArgs.preventDefault()

    let tabs = form.querySelectorAll(".tab-item")

    let title = form.querySelector("input[name='title']").value

    if (tabs.length < 1) {
      alert("There are no tabs added!")
      return
    }

    if (title.trim().length < 1) {
      console.log(title)
      alert("Add title!")
      return
    }

    tabs.forEach(tab => {
      let name = tab.querySelector("input.name")
      let text = tab.querySelector("textarea")

      if (name.value.trim().length < 1) 
        name.classList.add("error")
      else
        name.classList.remove("error")

      if (text.value.trim().length < 1) 
        text.classList.add("error")
      else
        text.classList.remove("error")
    })

    if (form.querySelectorAll(".error").length > 0)
      return

    
    // all checks passed, sending post data asynchronously to the server
    let request = new XMLHttpRequest()
    let data = new FormData(eventArgs.target)
    let url = form.getAttribute("action")

    request.addEventListener("load", (responseArgs) => {
      if (responseArgs.target.status == 200) {
        alert("Data stored succesfully!")
        console.log(responseArgs)
        return
      }

      alert("Data transfer processed with some errors. Open console to check them")
      console.log(responseArgs)
    })

    request.open("POST", url)
    request.send(data)
  }


  // add handlers to events
  document.querySelector(".add-row").addEventListener("click", addRow)
  form.addEventListener("submit", onFormSubmit)
  
  // check if theres already some rows added by php to add event handlers
  if (form.querySelectorAll(".tab-item").length > 0) {
    form.querySelectorAll(".tab-item").forEach(tabItem => {
      tabItem.querySelector(".remove span").addEventListener("click", removeRow)
      tabItem.querySelector(".move .up").addEventListener("click", moveRow)
      tabItem.querySelector(".move .down").addEventListener("click", (e) => moveRow(e, false))
    })
  }
})()