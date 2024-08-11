const like = document.getElementById('like');
const dislike = document.getElementById('dislike');
if (document.getElementById('postId')) {
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
}
