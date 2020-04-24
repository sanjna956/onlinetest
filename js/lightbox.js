    function showId(id)
{
    var obj = document.getElementById(id);
    obj.style.display = 'block';
    return false;
}
function hideId(id)
{
    var obj = document.getElementById(id);
    obj.style.display = 'none';
    return false;
}
function showLightBox()
{
    showId('outer');
    showId('inner');
}
function hideLightbox()
{
    hideId('inner');
    hideId('outer');
}
