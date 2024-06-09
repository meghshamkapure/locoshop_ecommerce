function delete_cat(cid = null) {
	if(cid) {
		var r = confirm("Are You Sure To Delete Category?");
		if(r==true){
			$.ajax({
				url: './delete_cat.php',
				type: 'post',
				data: {cid : cid},
				dataType: 'json',
				success:function(response) {
					if(response.success == true) {
						 location.reload();
						 alert("Category Deleted Successfully!");
						 $("#mes").html("ookkk");
					} else {
					} // /else
				} // /success
			});  // /ajax function to remove the order
	} else{
		location.reload();
	}
	}
	else {
		alert('error! refresh the page again');
	}	
}
function delete_subcat(scid = null) {
	if(scid) {
		var r = confirm("Are You Sure To Delete Sub Category?");
		if(r==true){
			$.ajax({
				url: './delete_subcat.php',
				type: 'post',
				data: {scid : scid},
				dataType: 'json',
				success:function(response) {
					if(response.success == true) {
						 location.reload();
						 alert("Sub Category Deleted Successfully!");
						 $("#mes").html("ookkk");
					} else {
					} // /else
				} // /success
			});  // /ajax function to remove the order
	} else{
		location.reload();
	}
	}
	else {
		alert('error! refresh the page again');
	}	
}
function delete_product(pid = null) {
	if(pid) {
		var r = confirm("Are You Sure To Delete Product?");
		if(r==true){
			$.ajax({
				url: './delete_product.php',
				type: 'post',
				data: {pid : pid},
				dataType: 'json',
				success:function(response) {
					if(response.success == true) {
						 location.reload();
						 alert("Product Deleted Successfully!");
						 $("#mes").html("ookkk");
					} else {
					} // /else
				} // /success
			});  // /ajax function to remove the order
	} else{
		location.reload();
	}
	}
	else {
		alert('error! refresh the page again');
	}	
}
// remove order from server
function approve_user(mycid = null) {
	if(mycid) {
		var r = confirm("Are You Sure To Approve Franchise User?");
		if(r==true){
			$.ajax({
				url: './approve_user.php',
				type: 'post',
				data: {mycid : mycid},
				dataType: 'json',
				success:function(response) {
					if(response.success == true) {
						 location.reload();
						 alert("Franchise User Approve Successfully!");
						 $("#mes").html("ookkk");
					} else {
					} // /else
				} // /success
			});  // /ajax function to remove the order
	} else{
		location.reload();
	}
	}
	else {
		alert('error! refresh the page again');
	}	
}
// remove order from server
function reject_user(mycid = null) {
	if(mycid) {
		var r = confirm("Are You Sure To Reject Franchise User?");
		if(r==true){
			$.ajax({
				url: './reject_user.php',
				type: 'post',
				data: {mycid : mycid},
				dataType: 'json',
				success:function(response) {
					if(response.success == true) {
						 location.reload();
						 alert("Franchise User Rejected Successfully!");
						 $("#mes").html("ookkk");
					} else {
					} // /else
				} // /success
			});  // /ajax function to remove the order
	} else{
		location.reload();
	}
	}
	else {
		alert('error! refresh the page again');
	}	
}
function delete_order(order_id = null) {
	if(order_id) {
		var r = confirm("Are You Sure To delete Order?");
		if(r==true){
			$.ajax({
				url: './order_delete.php',
				type: 'post',
				data: {order_id : order_id},
				dataType: 'json',
				success:function(response) {
					if(response.success == true) {
						 location.reload();
						 alert("Order Deleted Successfully!");
						 $("#mes").html("ookkk");
					} else {
					} // /else
				} // /success
			});  // /ajax function to remove the order
	} else{
		location.reload();
	}
	}
	else {
		alert('error! refresh the page again');
	}	
}
function delivered_order(order_id = null) {
	if(order_id) {
		var r = confirm("Are You Sure To Deliver Order?");
		if(r==true){
			$.ajax({
				url: './order_delivered.php',
				type: 'post',
				data: {order_id : order_id},
				dataType: 'json',
				success:function(response) {
					if(response.success == true) {
						 location.reload();
						 alert("Order Delivred Successfully!");
						 $("#mes").html("ookkk");
					} else {
					} // /else
				} // /success
			});  // /ajax function to remove the order
	} else{
		location.reload();
	}
	}
	else {
		alert('error! refresh the page again');
	}	
}
function delete_order_item(order_item_id = null) {
	if(order_item_id) {
		var r = confirm("Are You Sure To Delete Order Item?");
		if(r==true){
			$.ajax({
				url: './order_item_delete.php',
				type: 'post',
				data: {order_item_id : order_item_id},
				dataType: 'json',
				success:function(response) {
					if(response.success == true) {
						 location.reload();
						 alert("Order Item Deleted Successfully!");
						 $("#mes").html("ookkk");
					} else {
					} // /else
				} // /success
			});  // /ajax function to remove the order
	} else{
		location.reload();
	}
	}
	else {
		alert('error! refresh the page again');
	}	
}
function delete_enduser(euid = null) {
	if(euid) {
		var r = confirm("Are You Sure To Delete End User?");
		if(r==true){
			$.ajax({
				url: './delete_enduser.php',
				type: 'post',
				data: {euid : euid},
				dataType: 'json',
				success:function(response) {
					if(response.success == true) {
						 location.reload();
						 alert("User Deleted Successfully!");
						 $("#mes").html("ookkk");
					} else {
					} // /else
				} // /success
			});  // /ajax function to remove the order
	} else{
		location.reload();
	}
	}
	else {
		alert('error! refresh the page again');
	}	
}
function delete_slider(slider_id = null) {
	if(slider_id) {
		var r = confirm("Are You Sure To Delete Slider?");
		if(r==true){
			$.ajax({
				url: './delete_slider.php',
				type: 'post',
				data: {slider_id : slider_id},
				dataType: 'json',
				success:function(response) {
					if(response.success == true) {
						 location.reload();
						 alert("Slider Deleted Successfully!");
						 $("#mes").html("ookkk");
					} else {
					} // /else
				} // /success
			});  // /ajax function to remove the order
	} else{
		location.reload();
	}
	}
	else {
		alert('error! refresh the page again');
	}	
}
function approve_seller(sid = null) {
	if(sid) {
		var r = confirm("Are You Sure To Approve Seller?");
		if(r==true){
			$.ajax({
				url: './approve_seller.php',
				type: 'post',
				data: {sid : sid},
				dataType: 'json',
				success:function(response) {
					if(response.success == true) {
						 location.reload();
						 alert("Seller Approved Successfully!");
						 $("#mes").html("ookkk");
					} else {
					} // /else
				} // /success
			});  // /ajax function to remove the order
	} else{
		location.reload();
	}
	}
	else {
		alert('error! refresh the page again');
	}	
}
function reject_seller(sid = null) {
	if(sid) {
		var r = confirm("Are You Sure To Reject Seller?");
		if(r==true){
			$.ajax({
				url: './reject_seller.php',
				type: 'post',
				data: {sid : sid},
				dataType: 'json',
				success:function(response) {
					if(response.success == true) {
						 location.reload();
						 alert("Seller Rejected Successfully!");
						 $("#mes").html("ookkk");
					} else {
					} // /else
				} // /success
			});  // /ajax function to remove the order
	} else{
		location.reload();
	}
	}
	else {
		alert('error! refresh the page again');
	}	
}