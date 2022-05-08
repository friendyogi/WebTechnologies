

function validateForm() {
    var a = document.forms["profile"]["name"].value;
    if (a == null || a == ""){
        alert("A required field is not filled");
        document.forms["profile"]["name"].style.background = 'Yellow';
        return false;
    }
    var b = document.forms["profile"]["address"].value;
    if (b == null || b == ""){
        alert("A required field is not filled");
        document.forms["profile"]["address"].style.background = 'Yellow';
        return false;
    }
    var c = document.forms["profile"]["zipcode"].value;
    if (c == null || c == ""){
        alert("A required field is not filled");
        document.forms["profile"]["zipcode"].style.background = 'Yellow';
        return false;
    }
    var d = document.getElementById("country");
    var selectedValue = d.options[d.selectedIndex].value;
    if (selectedValue == "none"){
         alert("A required drop-down option is not selected");
        document.forms["profile"]["country"].style.background = 'Yellow';
        return false;       
    }
    var e = document.forms["profile"]["gender"].value;
    if (e == null || e == ""){
        alert("A required radio button is not selected");
        document.forms["profile"]["gender"].style.background = 'Yellow';
        return false;
    }
    var f = document.forms["profile"]["dob"].value;
    if (f == null || f == ""){
        alert("A required date field is not selected");
        document.forms["profile"]["dob"].style.background = 'Yellow';
        return false;
    }
    var g = document.getElementsByName("preferences");
    var selectedCheckboxes = false;
    for(var i=0, len=g.length; i<len; i++)
        {
            if(g[i].checked)
                {
                    selectedCheckboxes=true;
                    break;
                }
        }
    if(selectedCheckboxes == false)
        {
            alert("A required checkbox is not selected");
            return false;
        }
    var h = document.forms["profile"]["phone"].value;
    if (h == null || h == ""){
        alert("A required field is not filled");
        document.forms["profile"]["phone"].style.background = 'Yellow';
        return false;
    }
    var i = document.forms["profile"]["email"].value;
    if (i == null || i == ""){
        alert("A required field is not filled");
        document.forms["profile"]["email"].style.background = 'Yellow';
        return false;
    }
    var j = document.forms["profile"]["pass1"].value;
    if (j == null || j == ""){
        alert("A required field is not filled");
        document.forms["profile"]["pass1"].style.border = "2px solid Yellow";
        return false;
    }
  }
  
function verifyPassword(x) {
	var pass1 = document.getElementById("pass1");
	var pass2 = document.getElementById("pass2");
	if (pass1.value !== pass2.value) {
		alert("passwords do not match");
        document.getElementById("pass2").style.border = "2px solid red";
    }
        else {
		pass2.setCustomValidity("");
	}
}
