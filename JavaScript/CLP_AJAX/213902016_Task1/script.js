function decodeMessage() {
    const encodedMessage = document.getElementById('encodedMessage').value;
    const shiftValue = parseInt(document.getElementById('shiftValue').value);
    const decodedMessage = caesarCipherDecode(encodedMessage, shiftValue);
    document.getElementById('decodedMessage').textContent = `Decoded Message: ${decodedMessage}`;
}

function caesarCipherDecode(str, shift) {
    return str.split('').map(char => {
        if (char.match(/[a-z]/i)) {
            const code = char.charCodeAt();
            const base = code >= 65 && code <= 90 ? 65 : 97;
            return String.fromCharCode(((code - base - shift + 26) % 26) + base);
        }
        return char;
    }).join('');
}
