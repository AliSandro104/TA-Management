
//Display term select box only when a year is selected
function displayTaList() {
    // Get result from year select box
    var year = document.getElementById("year");
    // Get term select box
    var term = document.getElementById("term");
    // Get courses select box
    var course = document.getElementById("course");

    var TA_list = document.getElementById("ta");



    // If year is selected, show the term
    if (year.value != 'N/A' && term.value != 'N/A' && course.value != 'N/A'){
        TA_list.style.display = "initial";
        TA_list.required = true;
      

    } else {
        TA_list.style.display = "none";
        TA_list.required = false;
        alert("Please complete all selections")
       
    }
}



function returnVal(id){

    var val = document.getElementById(id);
    return val.value;

}