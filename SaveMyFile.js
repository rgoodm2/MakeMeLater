var fs = require("fs");
var JSZip = require("jszip");

var zip = new JSZip();
// zip.file("file", content);
// ... and other manipulations

var buffer = zip.generate({type:"nodebuffer"});

fs.writeFile("test.zip", buffer, function(err) {
  if (err) throw err;
});