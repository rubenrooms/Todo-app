document.querySelector("#doneBtn").addEventListener("click", function (e) {

    e.preventDefault();
    let todoId = this.dataset.todoid;

    let formData = new FormData();
    formData.append("todoId", todoId);

    if (document.querySelector(".doneBtn_" + todoId).value == "done") {
        fetch("ajax/done.php", {
            method: "POST",
            body: formData
        })
            .then((response) => response.json())
            .then((result) => {
                console.log("success: ", result);
                document.querySelector(".doneBtn_" + todoId).value = "not done";
            })
            .catch((error) => {
                console.error("err happened");
                console.error("Error:", error);
            });
    } else {
        fetch("ajax/notdone.php", {
            method: "POST",
            body: formData,
        })
            .then((response) => response.json())
            .then((result) => {
                console.log("success: ", result);
                document.querySelector(".doneBtn_" + todoId).value = "done";
            })
            .catch((error) => {
                console.error("err happened here");
                console.error("Error:", error);
            });
    }
});