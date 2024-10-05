<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Deliveryorder extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_login();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('Deliveryorder_model', 'deliveryorder');
    }

    public function index()
    {
        $data = [
            'title' => 'Delivery Order',
            'subtitle' => 'Data Delivery Order',
            'subtitle2' => 'Data Delivery Order',
            'deliveryorder' => $this->deliveryorder->getDeliveryorder(),

        ];
        $this->load->view('user/deliveryorder/index', $data);
    }

    // detail 
    public function detail($uuidDeliveryorder)
    {
        $data = [
            'title' => 'Delivery Order',
            'subtitle' => 'Detail Delivery Order',
            'subtitle2' => 'Detail Delivery Order',
            'detailDeliveryorder' => $this->deliveryorder->getItemsDeliveryorder($uuidDeliveryorder),
            'no_do' => $this->deliveryorder->getNoDoExt($uuidDeliveryorder),
            'uuid' => $uuidDeliveryorder,
        ];
        $this->load->view('user/deliveryorder/detailDeliveryorder', $data);
    }

    public function createDeliveryorder($uuidPacking)
    {
        $data = [
            'title' => 'Delivery Order',
            'subtitle' => 'Create Delivery Order',
            'subtitle2' => 'Create Delivery Order',
            'detailPacking' => $this->deliveryorder->getDetailPacking($uuidPacking),
            'uuid' => $uuidPacking,
        ];
        // var_dump($data['detailPs']);
        $this->load->view('user/deliveryorder/createDeliveryorder', $data);
    }

    public function processCreateDeliveryorder($uuidPacking)
    {
        // getidpacking
        $idPacking = $this->deliveryorder->getIdPacking($uuidPacking);
        $data = array(
            'uuid' => uniqid(),
            'no_deliveryorder' => generate_deliveryorder_number(),
            'ext_deliveryorder' => $this->input->post('no_do'),
            'id_packing' => $idPacking,
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => $this->session->userdata('id_users'),
            'status' => 0,
        );

        $insert = $this->deliveryorder->insertDeliveryOrder($data);
        if ($insert) {
            //update status packing ke 1 langsung saja tanpa ke model
            $this->db->where('uuid', $uuidPacking);
            $this->db->update('packing', array('status' => 1));
            $response = array('status' => 'success', 'message' => 'Delivery order created successfully.');
        } else {
            $response = array('status' => 'error', 'message' => 'Failed to create delivery.');
        }
        echo json_encode($response);
    }


    public function printDeliveryOrder($uuidDeliveryorder)
    {
        $deliveryorder = $this->deliveryorder->getDetailDeliveryorder($uuidDeliveryorder);
        $deliveryorderItems = $this->deliveryorder->getItemsDeliveryorder($uuidDeliveryorder);
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4', 'margin_left' => 8, 'margin_right' => 8, 'margin_top' => 10, 'margin_bottom' => 16, 'margin_header' => 9, 'margin_footer' => 9]);

        $mpdf->SetFont('Helvetica', '', 12);

        $footer = '<table style="width: 100%; border-collapse: collapse; border: none; font-size: 10px;">
        <tr>
            <td style="width: 50%; text-align: left; border: none;">Printed by Transtama Logistics WMS</td>
            <td style="width: 50%; text-align: right; border: none;">Page {PAGENO} of {nbpg}</td>
        </tr>
    </table>
    <hr style="border: 1px solid #ddd;">';
        $mpdf->SetFooter($footer, ['odd' => $footer, 'even' => $footer]);

        $html = '<style>
            .center {
                text-align: center;
            }
            table {
                border-collapse: collapse;
            }
            th{
                border: 1px solid #ddd;
                padding: 5px;
                text-align: center;
            }

            td {
                border: 1px solid #ddd;
                padding: 5px;
                text-align: center;
                
                white-space: nowrap;

            }
        </style>';

        $html .= '<div id="head" style="text-align: center;">';
        $html .= '<img src="https://tesla-smartwork.transtama.com/uploads/logoRaw.png" alt="Delivery Order" style="width: auto; height: 70px;">';
        $html .= '</div>';
        $html .= '<p class="center" ><b>Delivery Order : ' . $deliveryorder['ext_deliveryorder'] . '</b></p>';
        $totalitem = $deliveryorderItems->num_rows();

        $html .= '<table style="width: 100%; border-collapse: collapse; border: none;">';
        $html .= '<tr>';
        $html .= '<td style="width: 20%; text-align: left; border: none;">Tanggal</td>';
        $html .= '<td style="width: 5%; text-align: center; border: none;">:</td>';
        $html .= '<td style="width: 75%; text-align: left; border: none;">' . date('d-M-Y', strtotime($deliveryorder['created_at'])) . '</td>';
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '<td style="width: 20%; text-align: left; border: none;">Kepada</td>';
        $html .= '<td style="width: 5%; text-align: center; border: none;">:</td>';
        $html .= '<td style="width: 75%; text-align: left; border: none;">' . $deliveryorder['nama_customer'] . '</td>';
        $html .= '</tr>';
        $html .= '</table> <br><br></div>';
        $html .= '<table style="width: 100%"><tr><th>Item Number</th><th align="center">Item Name</th><th>Batch</th><th>Expired Date</th><th>Batch Qty</th><th>Remarks</th></tr>';

        $no = 1;
        $itemCount = 0;
        $totalItemCount = $deliveryorderItems->num_rows();

        foreach ($deliveryorderItems->result() as $item) {
            // ...
            $html .= '<tr>';

            $no++;
            $html .= '<td>' . $item->sku . '</td>';
            $html .= '<td>' . $item->nama_barang . '</td>';
            $html .= '<td>' . $item->batchnumber . '</td>';
            $html .= '<td>' . $item->expiration_date . '</td>';
            $html .= '<td>' . $item->qty . '</td>';
            $html .= '<td></td>';
            $html .= '</tr>';

            $itemCount++;

            if ($itemCount >= 20 && $no <= $totalItemCount) {
                $html .= '</table>'; // Close the table
                $mpdf->WriteHTML($html);

                $mpdf->AddPage(); // Add a new page
                $html = '<div id="head" style="text-align: center;">
        <img  src="https://tesla-smartwork.transtama.com/uploads/logoRaw.png" alt="Delivery Order" style="width: auto; height: 70px;">
        <p class="center" ><b>Delivery Order : ' . $deliveryorder['ext_deliveryorder'] . '</b></p>
        <table style="width: 100%; border-collapse: collapse; border: none;">
            <tr>
                <td style="width: 20%; text-align: left; border: none;">Tanggal</td>
                <td style="width: 5%; text-align: center; border: none;">:</td>
                <td style="width: 75%; text-align: left; border: none;">' . date('d-M-Y', strtotime($deliveryorder['created_at'])) . '</td>
            </tr>
            <tr>
                <td style="width: 20%; text-align: left; border: none;">Kepada</td>
                <td style="width: 5%; text-align: center; border: none;">:</td>
                <td style="width: 75%; text-align: left; border: none;">' . $deliveryorder['nama_customer'] . '</td>
            </tr>
        </table> <br><br>
    </div>'; // Add the header section again

                $html .= '<table style="width: 100%"><tr><th>Item Number</th><th>Item Name</th><th>Batch</th><th>Expired Date</th><th>Batch Qty</th><th>Remarks</th></tr>'; // Add a new table header

                $itemCount = 0;
            }
        }

        // Add the remaining items to the last page
        if ($itemCount > 0) {
            $html .= '</table>'; // Close the table
        }

        $html .= '<table id="tandatangan" style="width: 40%; margin-right: 0; margin-left: auto; border-collapse: collapse; border: 1; margin-top: 10px;"  keep-row-together="true">';
        $html .= '<tr>';
        $html .= '<td style="width: 50%; height:100px; text-align: center; "></td>';
        $html .= '<td style="width: 50%; height:0px; text-align: center; "></td>';
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '<td style="width: 50%; text-align: left;  border-bottom: 1px solid #ddd;font-size:10px">Tanggal :</td>';
        $html .= '<td style="width: 50%; text-align: left;  border-bottom: 1px solid #ddd;font-size:10px">Tanggal :</td>';
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '<td style="width: 50%; text-align: center;  border-bottom: 1px solid #ddd;">Tanda Tangan Penerima</td>';
        $html .= '<td style="width: 50%; text-align: center;  border-bottom: 1px solid #ddd;">Tanda Tangan Pengirim</td>';
        $html .= '</tr>';
        $html .= '</table>';
        $mpdf->WriteHTML($html);

        $mpdf->Output('delivery_order.pdf', 'I');
    }
}

/* End of file User.php */
