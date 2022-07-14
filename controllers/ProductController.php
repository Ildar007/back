<?php
// require_once "../controllers/ProductController.php";

class ProductController extends Controller
{
  private $productsModel;

  public function __construct()
  {
    $this->productsModel = $this->model('Product');
  }
  public function index()
  {
    $data = $this->productsModel->getProducts();
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode([
      'success' => true,
      'message' => 'Products retrieved successfully',
      'data' => $data
    ]);
  }
  public function addProduct()
  {
    header('Content-Type: application/json; charset=utf-8');
    $sku = $_POST['sku'];
    $checkSkuExist = $this->productsModel->checkItem($sku);
    if ($checkSkuExist > 0) {
      echo json_encode([
        'success' => false,
        'message' => 'Enter a unique SKU'
      ]);
      return;
    }
    $submitData = $this->productsModel->addProduct($_POST);
    if ($submitData == false) {
      echo json_encode([
        'success' => false,
        'message' => 'Error submitting product'
      ]);
      return;
    } else {
      echo json_encode([
        'success' => true,
        'message' => 'Product submitted'
      ]);
      return;
    }
  }
  public function deleteProducts()
  {
	header('Content-Type: application/json; charset=utf-8');
	$ids = ($_POST['ids']);

    $delete = $this->productsModel->deleteProducts($ids);
    if ($delete) {
      echo json_encode([
        'success' => true,
        'message' => 'Product deleted'
      ]);
      return;
    } else {
      echo json_encode([
        'success' => false,
        'message' => 'Product coule not be deleted'
      ]);
      return;
    }
  }
}
