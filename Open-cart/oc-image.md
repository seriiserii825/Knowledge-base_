catalog/controller/product/product.php
найдите 

 

$data['popup'] = $this->model_tool_image->resize($product_info['image'], $this->config->get($this->config->get('config_theme') . '_image_popup_width'), $this->config->get($this->config->get('config_theme') . '_image_popup_height'));
замените на 

 $data['popup'] = 'image/' . $product_info['image'];
Найдите 

'popup' => $this->model_tool_image->resize($result['image'], $this->config->get($this->config->get('config_theme') . '_image_popup_width'), $this->config->get($this->config->get('config_theme') . '_image_popup_height')),
замените на 

'popup' => 'image/' . $result['image'],
Обновите кеш модификаторов. В карточке товара основное изображение будет в оригинальном его размере.
