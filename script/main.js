function Add_Row(){
    date = document.getElementById("日期輸入").value
    actual_location = document.getElementById("地點輸入").value
    power = document.getElementById("電表度數輸入").value

    new_row = document.getElementById("電表清單").insertRow()
    new_row.classList.add("資料")

    cell = new_row.insertCell()
    cell.innerHTML = date
    cell = new_row.insertCell()
    cell.innerHTML = actual_location
    cell = new_row.insertCell()
    cell.innerHTML = power
}

function loadTab(event, mode){
    // Declare all variables
    var i, tabcontent, tablinks;

    // Get all elements with class="tabcontent" and hide them
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
    }

    // Get all elements with class="tablinks" and remove the class "active"
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

    // Show the current tab, and add an "active" class to the button that opened the tab
    document.getElementById(mode).style.display = "block";
    event.currentTarget.className += " active";
}