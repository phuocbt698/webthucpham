function createSlug(e){
    var slug = document.getElementById('slug');
    var title = e.target.value;
    var slugText = title.toLowerCase()
             .replace(/[^\w ]+/g, '')
             .replace(/ +/g, '-');
    slug.value = slugText;
    console.log(slugText);
}