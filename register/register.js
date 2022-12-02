
//to check if the student checkbox is checked and display student ID field
function displayStudentID() {
    // Get the student checkbox
    var checkBox = document.getElementById("isStudent");
    // Get the student ID box field
    var field = document.getElementById("sID");

    // If the checkbox is checked, display the student ID field and make it required
    if (checkBox.checked == true){
        field.style.display = "initial";
        field.required = true;
      

    } else {
        field.style.display = "none";
        field.required = false;
       
    }
}



//javascript code for dropdown checkbox
var expanded = false;

function showCheckboxes() {
  var checkboxes = document.getElementById("checkboxes");
  if (!expanded) {
    checkboxes.style.display = "block";
    expanded = true;
  } else {
    checkboxes.style.display = "none";
    expanded = false;
  }
}
