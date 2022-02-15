 function generatepdf(){
	 const element = document.getElementById("PurchaseOrder");
	 
	 html2pdf()
	 .from(element)
	 .save();
 }