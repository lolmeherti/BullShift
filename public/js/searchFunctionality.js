//search functionality for managers in department
let searchForManagerByUserName = (url, query) =>
{
    axios.post(url, {
        query: query
    }, {
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json'
        }
    }).then(function (response) {
        //the controller will check for dependencies before deleting
        if(response.data)
        {
            let users = response.data.managers;
            let list = document.getElementById('usersFound');
            list.innerHTML = '';
            for(let index = 0; index<users.length; index++)
            {
                // Create a new list element
                const li = document.createElement("li");

                // Create a new link element
                const link = document.createElement("a");

                // Set the link attributes
                link.href = "#";
                link.className = "flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white";
                link.addEventListener("click", function() {
                    setManagerName(users[index].name, users[index].id);
                });

                // Create a new image element
                const img = document.createElement("img");

                // Set the image attributes
                img.className = "w-6 h-6 mr-2 rounded-full";
                img.src = window.location.origin + "/images/1676204359.jpg";
                img.alt = "profile_picture_" + users[index].name;

                // Create a new text node
                const text = document.createTextNode(users[index].name);

                // Append the image and text to the link element
                link.appendChild(img);
                link.appendChild(text);

                // Append the link to the list element
                li.appendChild(link);

                // Append the list element to the list
                list.appendChild(li);
            }
        }
    })
        .catch(function (error) {
            console.log(error);
        });
}
