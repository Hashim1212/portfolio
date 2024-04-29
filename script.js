
function saveChanges() {
    var newValue = document.getElementById("newValue").value;
    var id = recordId; 
    var field = "content"; 

    
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "update.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                
                document.getElementById("content-" + recordId).innerText = newValue;
                closeModal();
            } else {
                
                console.error("Error updating content:", xhr.responseText);
            }
        }
    };
    
    var params = "id=" + id + "&field=" + field + "&newValue=" + encodeURIComponent(newValue);
    xhr.send(params);
}
