document.querySelector("#commentBtn").addEventListener("click", function () {

    let todoId = this.dataset.todoid;
    let text = document.querySelector("#commentText").value;

    console.log(todoId);
    console.log(text)

    let formData = new FormData();
    formData.append("text", text);
    formData.append("todoId", todoId);

    fetch("ajax/savecomment.php", {
        method: "POST",
        body: formData,

    })
        .then((response) => response.json())
        .then((result) => {
            let newComment = document.createElement("li");
            newComment.className = "py-2 px-2 rounded-3 bg-light list-group-item"
            newComment.innerHTML = result.body;
            document
                .querySelector(".commentsOnTodo")
                .appendChild(newComment);
        })
        .catch((error) => {
            console.error("err happened here");
            console.error("Error:", error);
        });
});