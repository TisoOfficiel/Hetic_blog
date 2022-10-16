function editTweet(user_id, id) {
    window.scrollTo({ top: 0, behavior: 'smooth' });
    var x = document.getElementById("modalEdit");
    var content = document.getElementById(id).textContent;
    
    if (x.style.display === "none") {
        x.style.display = "flex";
    } else {
        x.style.display = "none";
    }
    
    document.getElementById('content_tweet_edit').value = content;
    document.getElementById('tweet_id').value = id;
    document.getElementById('user_id').value = user_id;
};

function closeModal() {
    var x = document.getElementById("modalEdit").style.display="none";
}