function checkInputValues() {
    const inputs = document.querySelectorAll('input');
    return Array.from(inputs).every(input => input.value !== '');
}

let showCreatingInProgress = () =>
{
    if(checkInputValues())
    {
        document.getElementById('creation_text').classList.remove('hidden');
        document.getElementById('creation_success_message').innerHTML = "";
    }
}
