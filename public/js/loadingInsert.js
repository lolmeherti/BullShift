function checkInputValues() {
    const inputs = document.querySelectorAll('input');
    return Array.from(inputs).every(input => input.value !== '');
}

let showCreatingInProgress = () =>
{
    if(checkInputValues())
    {
        disableCreateButton();
        //this will show the animated spinner when works being done
        document.getElementById('loading_spinner_animated').classList.remove('hidden');
        document.getElementById('creation_success_message').innerHTML = "";
    }
}

//the reason why departments have a separate showInProgress function is because
//the default showInProgress will check if all fields contain values before it shows animations
//but in departments, assigning a manager is optional
let showCreatingDepartmentInProgress = () =>
{
    let fieldValue = document.getElementById('department').value;

    if(fieldValue)
    {
        disableCreateButton();
        document.getElementById('loading_spinner_animated').classList.remove('hidden');
        document.getElementById('creation_success_message').innerHTML = "";
    }
}

//this function disabled the create button
let disableCreateButton = () =>
{
    //the cursor will no longer display as a pointer
    document.getElementById("create_button").style.cursor = "auto";

    //removing green bg color from the create button
    document.getElementById("create_button").classList.remove("bg-green-600");
    document.getElementById("create_button_highlighted").classList.remove("bg-green-500");

    //making button gray so the users understand to not click it again
    document.getElementById("create_button").classList.add("bg-gray-400");
    document.getElementById("create_button_highlighted").classList.add("bg-gray-400");

    //even if the users click it again, it will do nothing. it will only display the forbidden cursor
    document.getElementById("create_button").addEventListener("click", function(event){
        document.getElementById("create_button").style.cursor = "not-allowed";
        event.preventDefault();
    });
}
