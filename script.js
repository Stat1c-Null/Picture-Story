const noteOn = false;

function hideNote() {
    document.getElementById('note').style.visibility='hidden';
    noteOn = false;
};

function showNote() {
    document.getElementById('note').style.visibility='visible';
    noteOn = true;
}
