/*                    <div>
                    <button id="like" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Lubię to</button>
                </div>
                <div>
                    <button id="dislike" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Nie lubię</button>
                </div>*/
const like = document.getElementById('like');
const dislike = document.getElementById('dislike');
const postId = document.getElementById('postId').value;
like.addEventListener('click', () => {
    axios.post(`/posts/${postId}/like`, {}).then(response => {
        alert(response.data.message);
    }).catch(error => {
        alert(error.response.data.message);
    });
})
dislike.addEventListener('click', () => {
    axios.post(`/posts/${postId}/dislike`, {}).then(response => {
        alert(response.data.message);
    }).catch(error => {
        alert(error.response.data.message);
    });
})
