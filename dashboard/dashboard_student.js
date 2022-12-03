
//Display term select box only when a year is selected
function displayTaList() {
    // Get result from year select box
    var year = document.getElementById("year");
    // Get term select box
    var term = document.getElementById("term");
    // Get courses select box
    var course = document.getElementById("course");

    var TA_list = document.getElementById("ta-select");



    // If year is selected, show the term
    if (year.value != 'N/A' && term.value != 'N/A' && course.value != 'N/A'){
        TA_list.style.display = "initial"; 
      

    } else {
        TA_list.style.display = "none";
        alert("Please complete all selections")
       
    }
}



