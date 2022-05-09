function copy(text) {
    navigator.clipboard.writeText(text)
}

function copyEmailBody(id) {
    navigator.clipboard.writeText(`localhost/index.php?link=password-reset.php&id=${id}`)
}