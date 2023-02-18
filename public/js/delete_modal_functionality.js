

let deleteConfirmation = (id, name) => {
    let deletionText = "Delete ";

    document.getElementById('myModal').showModal();
    document.getElementById("deletion_warning").innerHTML = deletionText + name + "?";

    //this hidden input will contain the id of the entry we want to delete
    document.getElementById("pending_deletion_id").value = id;
}

//attempting to delete
let deleteRequest = (postUrl) => {
    let id = document.getElementById("pending_deletion_id").value;

    showModalSpinner();

    axios.post(postUrl, {
        id: id
    }, {
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json'
        }
    })
        .then(function (response) {
            //the controller will check for dependencies before deleting
            if(response.data.dependency)
            {
                //note for state of code
                //if this code is extracted in refactor, the data.dependency message still needs to be passed as a parameter.
                //extraction doesn't make too much of a difference at this point in time

                //we enter in here if dependencies are found
                document.getElementById('deletion_warning_message').innerHTML = response.data.dependency;

                //change the button text to "Close"
                document.getElementById('cancel_button_text').innerHTML = "Close";

                //make the subtext inside the modal red
                document.getElementById("deletion_warning_message").classList.remove("dark:text-gray-400");
                document.getElementById("deletion_warning_message").classList.remove("text-gray-400");
                document.getElementById("deletion_warning_message").classList.add("text-red-500");

                showOnlyCancelButton();
            } else {//no dependencies, deleted successfully
                closeModal();
                //resetting modal
                document.getElementById("table_row_id" + id).remove();
                showModalButtons();
            }

        })
        .catch(function (error) {
            console.log(error);
        });
}

//HELPER FUNCTIONS
let closeModal = () => {
    document.getElementById('myModal').close();

    document.getElementById("pending_deletion_id").value = "";

    resetDeletionSubText();
    showModalButtons();
}

let resetDeletionSubText = () =>
{
    document.getElementById("deletion_warning_message").innerHTML = "This action is permanent. Are you sure you want to proceed?";
    document.getElementById("cancel_button_text").innerHTML = "No, cancel";
    document.getElementById("deletion_warning_message").classList.add("text-gray-400");
    document.getElementById("deletion_warning_message").classList.add("dark:text-gray-400");
    document.getElementById("deletion_warning_message").classList.remove("text-red-500");
}

let showModalButtons = () => {
    document.getElementById("consent_to_deletion_button").classList.remove("hidden");
    document.getElementById("deletion_cancel_button").classList.remove("hidden");
    document.getElementById("deletion_spinner").classList.add("hidden");
}

let showOnlyCancelButton = () => {
    document.getElementById("deletion_spinner").classList.add("hidden");
    document.getElementById("consent_to_deletion_button").classList.add("hidden");
    document.getElementById("deletion_cancel_button").classList.remove("hidden");
}

let showModalSpinner = () => {
    document.getElementById("consent_to_deletion_button").classList.add("hidden");
    document.getElementById("deletion_cancel_button").classList.add("hidden");
    document.getElementById("deletion_spinner").classList.remove("hidden");
}
