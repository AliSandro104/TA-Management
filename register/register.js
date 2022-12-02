//JAVASCRIPT FOR Student SECTION

//to check if the student checkbox is checked and display student ID field
function displayStudentID() {
    // Get the student checkbox
    var checkBox = document.getElementById("isStudent");
    // Get the student ID box field
    var field = document.getElementById("sID");

    // If the checkbox is checked, display the student ID field and make it required
    if (checkBox.checked){
        field.style.display = "initial";
        field.required = true;
      

    } else {
        field.style.display = "none";
        field.required = false;
       
    }
}

//to check if the student checkbox is checked and display student ID field
function displayStudentCourses() {
    // Get the student checkbox
    var checkBox = document.getElementById("isStudent");
    // Get the student ID box field
    var courses = document.getElementById("Student_courses");

    // If the checkbox is checked, display the student ID field and make it required
    if (checkBox.checked){
        courses.style.display = "initial";
      
    } else {
        courses.style.display = "none";
       
    }
}

var Student_expanded = false;

function showStudentCheckboxes() {
  var checkboxes = document.getElementById("Student_checkboxes");
  if (!Student_expanded) {
    checkboxes.style.display = "block";
    Student_expanded = true;
  } else {
    checkboxes.style.display = "none";
    Student_expanded = false;
  }
}



// #####################################################

//JAVASCRIPT FOR PROF SECTION

//to check if the student checkbox is checked and display student ID field
function displayProfCourses() {
    // Get the student checkbox
    var checkBox = document.getElementById("isProf");
    // Get the student ID box field
    var courses = document.getElementById("Prof_courses");

    // If the checkbox is checked, display the student ID field and make it required
    if (checkBox.checked == true){
        courses.style.display = "initial";
      
    } else {
        courses.style.display = "none";
       
    }
}

var Prof_expanded = false;

function showProfCheckboxes() {
  var checkboxes = document.getElementById("Prof_checkboxes");
  if (!Prof_expanded) {
    checkboxes.style.display = "block";
    Prof_expanded = true;
  } else {
    checkboxes.style.display = "none";
    Prof_expanded = false;
  }
}

// #####################################################

//JAVASCRIPT FOR TA SECTION

//to check if the student checkbox is checked and display student ID field
function displayTaCourses() {
    // Get the student checkbox
    var checkBox = document.getElementById("isTA");
    // Get the student ID box field
    var courses = document.getElementById("Ta_courses");

    // If the checkbox is checked, display the student ID field and make it required
    if (checkBox.checked == true){
        courses.style.display = "initial";
      
    } else {
        courses.style.display = "none";
       
    }
}

var Ta_expanded = false;

function showTaCheckboxes() {
  var checkboxes = document.getElementById("Ta_checkboxes");
  if (!Ta_expanded) {
    checkboxes.style.display = "block";
    Ta_expanded = true;
  } else {
    checkboxes.style.display = "none";
    Ta_expanded = false;
  }
}


var checkForm = function () {

  var errors = [];
  var pass= document.getElementById('pass');
  var cpass = document.getElementById('cpass');
  var isStudent = document.getElementById('isStudent');
  var isTA = document.getElementById('isStudent');



  //check if at least one user type is selected
  if(pass!=cpass){
    errors.push("Passwords do not match");
  }

  //check if at least one user type is selected
  if(!$('#BoxSelect input[type="checkbox"]').is(':checked')){
    errors.push("Please select at least one user type!");
  }
 
  //check if student option is selected and at least 1 course is selected
  if(isStudent && (!$('#StudentCourses input[type="checkbox"]').is(':checked')))
    errors.push("Student must choose at least 1 course");

  //check if ta option is selected and at least 1 course is selected
  if(isTA && (!$('#taCourses input[type="checkbox"]').is(':checked')))
    errors.push("Teacher Assistant must choose at least 1 course");
  
  alert(errors.join('\n'));
}