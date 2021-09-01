# controller header.php

$data['prodotti'] = $this->url->link('information/information', 'information_id=7');
$data['initiative'] = $this->url->link('information/information', 'information_id=8');
$data['come_funziona'] = $this->url->link('information/information', 'information_id=9');
$data['chi_siamo'] = $this->url->link('information/information', 'information_id=10');
$data['contatti'] = $this->url->link('information/information', 'information_id=11');

# template header.tpl

<ul class="main-menu">
        <li><a href="#">Home</a></li>
        <li><a href="/prodotti">Prodotti</a></li>
        <li><a href="<?php echo $initiative; ?>">Iniziative promozionali</a></li>
        <li><a href="<?php echo $come_funziona; ?>">Come funziona</a></li>
        <li><a href="<?php echo $chi_siamo; ?>">Chi siamo</a></li>
        <li><a href="<?php echo $contatti;?>">Contatti</a>
</ul>

# controller information

    		if (file_exists(DIR_TEMPLATE . $this->config->get('theme_default_directory') . '/template/information/information_' . $information_id . '.tpl')) {
    			$this->response->setOutput($this->load->view('information/information_' . $information_id, $data));
    		} else {
    			$this->response->setOutput($this->load->view('information/information', $data));
    		}

# create files in view

information.tpl
information_7.tpl
information_8.tpl
information_9.tpl

# create layout, route information/information.

# create page, design -> layout name

# get information id

if (isset($this->request->get['information_id'])) {
        $information_id = (int)$this->request->get['information_id'];
} else {
$information_id = 0;
}
