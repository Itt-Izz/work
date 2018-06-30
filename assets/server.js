var http=require('http');
var querystring=require('querystring');

function accountExists (email){
	var email=['you@email.com', 'itt@email.com', 'admin.email.com'];
	return emails.indexOf(email)+-1;
}

//Website.com/valid?email=...
var server=http.createServer(function(req, res){
  
  var params=req.url.spli('?')[1];
  var data=querystring.parse(params);
  var email=data.email;

  res.statusCode=200;
  res.setHeader("Content-Type", "application/json");
  res.setHeader("Access-Control-Allow-Origin","*");
  re.setHeader("Access-Control-Allow-Origin","Origin, X-Requested-with, Content-Type, Accept");

  if(accountExists(email)){
  	re.write('""');
  }else{
  	res.write('"true"');
  }
res.end();

});
server_listen(3000);