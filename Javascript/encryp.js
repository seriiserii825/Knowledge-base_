import CryptoJS from "crypto-js";
function encryptData(data) {
  return CryptoJS.AES.encrypt('my message', 'secret key 123').toString();
}
function decryptData(data) {
  const bytes = CryptoJS.AES.decrypt(data, 'secret key 123');
  return bytes.toString(CryptoJS.enc.Utf8);
}


let encrypted_message = encryptData('some message');
let decrypted_message = decryptData(encrypted_message);
