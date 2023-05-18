<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Company_Info extends Seeder
{
    public function run()
    {
        //
        

 

 $data = [
   'company_name' => 'GreenTech Solutions',
   'email' => 'info@greentechsolutions.com',
   'mobile' => '0987654328',
   'url' => 'www.greentechsolutions.com',
   'company_desc' => 'Sustainable Technology Initiatives',
   'division' => '3',
   'district' => '19',
   'thana' => '1',
   'area' => '4',
   "user_id"=>"1",
];
$this->db->table('customers')->insert($data);
 $data = [
   'company_name' => 'Global Trade Partners',
   'email' => 'info@globaltradepartners.com',
   'mobile' => '0123456709',
   'url' => 'www.globaltradepartners.com',
   'company_desc' => 'International Trading Services',
   'division' => '5',
   'district' => '36',
   'thana' => '4',
   'area' => '2',
   "user_id"=>"1",
];
$this->db->table('customers')->insert($data);
 $data = [
   'company_name' => 'HealthCare Solutions',
   'email' => 'info@healthcaresolutions.com',
   'mobile' => '0987654311',
   'url' => 'www.healthcaresolutions.com',
   'company_desc' => 'Comprehensive Healthcare Services',
   'division' => '1',
   'district' => '12',
   'thana' => '3',
   'area' => '5',
   "user_id"=>"1",
];
$this->db->table('customers')->insert($data);
$data = [
    'company_name' => 'Infinite Solutions',
    'email' => 'info@infinitesolutions.com',
    'mobile' => '0123456712',
    'url' => 'www.infinitesolutions.com',
    'company_desc' => 'End-to-End IT Services',
    'division' => '8',
    'district' => '62',
    'thana' => '2',
    'area' => '1',
    "user_id"=>"1",
    ];
    $this->db->table('customers')->insert($data);
    $data = [
        'company_name' => 'MegaCorp Industries',
        'email' => 'info@megacorpindustries.com',
        'mobile' => '0987654319',
        'url' => 'www.megacorpindustries.com',
        'company_desc' => 'Diversified Industrial Solutions',
        'division' => '7',
        'district' => '51',
        'thana' => '4',
        'area' => '3',
        "user_id"=>"1",
        ];

        $this->db->table('customers')->insert($data);
        $data = [
            'company_name' => 'Digital Nexus',
            'email' => 'info@digitalnexus.com',
            'mobile' => '0123456731',
            'url' => 'www.digitalnexus.com',
            'company_desc' => 'Digital Transformation Services',
            'division' => '4',
            'district' => '29',
            'thana' => '3',
            'area' => '2',
            "user_id"=>"1",
            ];

            $this->db->table('customers')->insert($data);
            $data = [
                'company_name' => 'AgroTech Solutions',
                'email' => 'info@agrotechsolutions.com',
                'mobile' => '0987654320',
                'url' => 'www.agrotechsolutions.com',
                'company_desc' => 'Modern Agricultural Solutions',
                'division' => '3',
                'district' => '17',
                'thana' => '1',
                'area' => '5',
                "user_id"=>"1",
                ];
                $this->db->table('customers')->insert($data);

                $data = [
                    'company_name' => 'ConsultPro Advisors',
                    'email' => 'info@consultproadvisors.com',
                    'mobile' => '0123456739',
                    'url' => 'www.consultproadvisors.com',
                    'company_desc' => 'Business Consulting Services',
                    'division' => '6',
                    'district' => '45',
                    'thana' => '2',
                    'area' => '4',
                    "user_id"=>"1",
                    ];
                    $this->db->table('customers')->insert($data);
    }
}
