residential_threshold = [1000, 700, 500, 330, 120]
commercial_threshold = [3000, 1500, 700, 330]

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

function Add_Row(ID, Date, Power, Environment){
    new_row = document.getElementById("電表清單").insertRow()
    new_row.id = "Row_" + ID
    new_row.classList.add("資料")

    // Data
    cell = new_row.insertCell()
    cell.innerHTML = ID
    cell = new_row.insertCell()
    cell.innerHTML = Date
    cell = new_row.insertCell()
    cell.innerHTML = Power
    cell = new_row.insertCell()
    cell.innerHTML = Environment

    // Control
    cell = new_row.insertCell()
    modify_button = document.createElement("button")
    cell.appendChild(modify_button)
    modify_button.id = "Modify_" + ID
    modify_button.innerHTML = "修改"
    modify_button.addEventListener("click", function(){
        controller(this.id)
    })

    cell = new_row.insertCell()
    delete_button = document.createElement("button")
    cell.appendChild(delete_button)
    delete_button.id = "Delete_" + ID
    delete_button.innerHTML = "刪除"
    delete_button.addEventListener("click", function(){
        controller(this.id)
    })

    cell = new_row.insertCell()
    confirm_button = document.createElement("button")
    cell.appendChild(confirm_button)
    confirm_button.id = "Confirm_" + ID
    confirm_button.innerHTML = "確認"
    confirm_button.style.display = "none"
    confirm_button.addEventListener("click", function(){
        controller(this.id)
    })

    cell = new_row.insertCell()
    cancel_button = document.createElement("button")
    cell.appendChild(cancel_button)
    cancel_button.id = "Cancel_" + ID
    cancel_button.innerHTML = "取消"
    cancel_button.style.display = "none"
    cancel_button.addEventListener("click", function(){
        controller(this.id)
    })

}

modify_flag = 0
delete_flag = 0

function controller(object_id){
    mode = object_id.split("_")[0]
    id = object_id.split("_")[1]

    confirm_button = document.getElementById("Confirm_" + id)
    cancel_button = document.getElementById("Cancel_" + id)
    switch (mode){
        case "Modify":
            if(modify_flag == 0 && delete_flag == 0){
                confirm_button.style.display = "inline"
                cancel_button.style.display = "inline"

            
                create_modify_form(id)
                modify_flag = 1
            }
            else{
                alert("不可一次修改多行!")
            }
            break
        case "Delete":
            delete_flag = 1
            if(confirm("你確定刪除ID為 " + id + " 這行嗎?")){
                run_delete_form(id)
            }
            else{
                // I guess I don't have to do anything here?
            }
            delete_flag = 0
            break
        case "Confirm":
            confirm_button.style.display = "none"
            cancel_button.style.display = "none"

            modify_flag = 0
            modify_form.submit()
            break
        case "Cancel":
            confirm_button.style.display = "none"
            cancel_button.style.display = "none"

            modify_flag = 0
            destroy_modify_form(id)
            break
        default:
            alert("controller gone wrong with mode " + mode + " and id " + id)
            return
    }
}

temp_date = undefined
temp_power = undefined
temp_environment = undefined

function create_modify_form(id){
    table_row = document.getElementById("Row_" + id)
    date_cell = table_row.children[1]
    power_cell = table_row.children[2]
    environment_cell = table_row.children[3]
    confirm_button = document.getElementById("Confirm_" + id)

    modify_form = document.createElement("form")
    // modify_form.action = "https://httpbin.org/post"
    modify_form.action = "./modify.php"
    modify_form.method = "post"
    modify_form.id = "modify_form"
    modify_form.style.display = "none"
    document.body.appendChild(modify_form)

    date_value = date_cell.innerHTML
    power_value = power_cell.innerHTML
    environment_value = environment_cell.innerHTML

    temp_date = date_value
    temp_power = power_value
    temp_environment = environment_value

    dummy_ID_input = document.createElement("input")
    dummy_ID_input.setAttribute("form", "modify_form")
    dummy_ID_input.name = "Serial_no"
    dummy_ID_input.value = id
    dummy_ID_input.style.display = "none"
    document.body.appendChild(dummy_ID_input)

    date_input = document.createElement("input")
    date_input.setAttribute("form", "modify_form")
    date_input.type = "date"
    date_input.id = "date_" + id
    date_input.name = "Date"
    date_input.value = date_value
    date_cell.innerHTML = ""
    date_cell.appendChild(date_input)

    power_input = document.createElement("input")
    power_input.setAttribute("form", "modify_form")
    power_input.type = "number"
    power_input.id = "power_" + id
    power_input.name = "KWH"
    power_input.value = power_value
    power_cell.innerHTML = ""
    power_cell.appendChild(power_input)

    environment_input = document.createElement("select")
    environment_input.setAttribute("form", "modify_form")
    environment_input.id = "environment_" + id
    environment_input.name = "Environment"
    residential_option = document.createElement("option")
    residential_option.value = "住宅"
    residential_option.innerHTML = "住宅"
    commercial_option = document.createElement("option")
    commercial_option.value = "商用"
    commercial_option.innerHTML = "商用"
    environment_input.appendChild(residential_option)
    environment_input.appendChild(commercial_option)
    if(environment_value == "住宅"){
        residential_option.selected = true
    }
    else{
        commercial_option.selected = true
    }
    environment_cell.innerHTML = ""
    environment_cell.appendChild(environment_input)

}

function destroy_modify_form(id){
    table_row = document.getElementById("Row_" + id)
    date_cell = table_row.children[1]
    power_cell = table_row.children[2]
    environment_cell = table_row.children[3]

    date_cell.removeChild(date_cell.children[0])
    date_cell.innerHTML = temp_date

    power_cell.removeChild(power_cell.children[0])
    power_cell.innerHTML = temp_power

    environment_cell.removeChild(environment_cell.children[0])
    environment_cell.innerHTML = temp_environment

    document.body.removeChild(document.getElementById("modify_form"))
}

function run_delete_form(id){

    delete_form = document.createElement("form")
    // modify_form.action = "https://httpbin.org/post"
    delete_form.action = "./delete.php"
    delete_form.method = "post"
    delete_form.id = "delete_form"
    delete_form.style.display = "none"
    document.body.appendChild(delete_form)

    dummy_ID_input = document.createElement("input")
    dummy_ID_input.setAttribute("form", "delete_form")
    dummy_ID_input.name = "Serial_no"
    dummy_ID_input.value = id
    dummy_ID_input.style.display = "none"
    document.body.appendChild(dummy_ID_input)

    delete_form.submit()
}

function calculate(){
    // TODO: write client side calculation and show in browser
    if(Environment == "住宅"){
        for(index in residential_threshold){

        }
    }
    if(Environment == "商用"){
        for(index in commercial_threshold){

        }
    }
}