function confirmDelete(product_id) {
    if (confirm("Are you sure you want to delete this product?")) {
      deleteProduct(product_id);
    }
  }
  
  function deleteProduct(product_id) {
    $.ajax({
      url: "/handelProduct.php",
      method: "POST",
      data: { product_id: product_id },
      success: function(response) {
        if (response.success) {
          // Update the UI to reflect the deleted product
        } else {
          alert("Failed to delete product. Please try again.");
        }
      },
      error: function() {
        alert("Failed to delete product. Please try again.");
      }
    });
  }