document.querySelector("#commentBtn").addEventListener("click", function () {

    let todoId = this.dataset.todoid;
    let text = document.querySelector("#commentText").value;

    console.log(todoId);
    console.log(text)
});