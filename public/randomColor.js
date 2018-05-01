function ran_col() { //function name
    var color = '#'; // hexadecimal starting symbol
    //var letters = ['000000','FF0000','00FF00','0000FF','FFFF00','00FFFF','FF00FF','C0C0C0']; //Set your colors here
    var randomColor = Math.floor(Math.random()*16777215).toString(16);
    color += randomColor;
    var allTitles = document.getElementsByClassName('randomBackground')
    var counter;
    for (counter = 0; counter < allTitles.length; counter++) {
        allTitles[counter].style.backgroundColor = color;
    }
}