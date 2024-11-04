//Grab the id for the form that needs to be made visible
const editFormDiv = document.getElementById('edit-posts-form');

//Form is by default hidden so this variable is false
let formVisible = false;

//Swap visibility around of the editFormDiv
function changeEditFormStatus(){
    if(!formVisible){
        editFormDiv.style.display = 'block';
        formVisible = true;
        //
        setFormValues();
    } else {
        editFormDiv.style.display = 'none';
        formVisible = false;
    }
}

function getClickedPostId(){

}

function setFormValues(){
    const editFormPostIdField = document.getElementById('editPostId');
    editFormPostIdField.value = "5";
}


