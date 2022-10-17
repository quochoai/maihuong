var ua = detect.parse(navigator.userAgent);

ua.browser.family // "Mobile Safari"
ua.browser.name // "Mobile Safari 4.0.5"
ua.browser.version // "4.0.5"
ua.browser.major // 4
ua.browser.minor // 0
ua.browser.patch // 5

ua.device.family // "iPhone"
ua.device.name // "iPhone"
ua.device.version // ""
ua.device.major // null
ua.device.minor // null
ua.device.patch // null
ua.device.type // "Mobile"
ua.device.manufacturer // "Apple"

ua.os.family // "iOS"
ua.os.name // "iOS 4"
ua.os.version // "4"
ua.os.major // 4
ua.os.minor // 0
ua.os.patch // null

console.log('Browser: ' + ua.browser.name + ' version: ' + ua.browser.version);
console.log('OS: ' + ua.os.family + ' ' + ua.os.version);
console.log('Device type: ' + ua.device.type);
console.log('OS Version: ' + ua.os.version);
console.log('Device name: ' + ua.device.name);
console.log('Manufacturer: ' + ua.device.manufacturer);
