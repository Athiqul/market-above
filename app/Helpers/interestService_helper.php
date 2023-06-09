<?php
if(!function_exists('interestServices'))
{
    //according to meeting interest
    function interestServices($id)
    {
        $interest=new \App\Models\InterestServicesModel();
        $interest->select('services.service_name,interest_services.id as interest_id,services.id as service_id');
        $interest->join('services','interest_services.services_id=services.id');
        $interest->where('interest_services.meeting_id',$id);
       
        return $interest->get()->getResult();
    }
    
    function servicesInfo($id)
    {
        $service=new App\Models\ServicesModel();
        return $service->find($id);
    }
    

    
}

?>