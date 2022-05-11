function copy(text) {
    navigator.clipboard.writeText(text)
}

function copyEmailBody(id) {
    navigator.clipboard.writeText(`www.moje-tipovacka.cz/index.php?link=password-reset.php&id=${id}`)
}