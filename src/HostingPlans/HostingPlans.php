<?php


namespace KeyHelpAPI\HostingPlans;

use GuzzleHttp\Exception\GuzzleException;
use KeyHelpAPI\KeyHelpAPI;

class HostingPlans
{
    private $KeyHelpAPI;

    public function __construct(KeyHelpAPI $KeyHelpAPI)
    {
        $this->KeyHelpAPI = $KeyHelpAPI;
    }

    /**
     * @return array|string
     * @throws GuzzleException
     */
    public function getHostingPlans()
    {
        return $this->KeyHelpAPI->get('hosting-plans');
    }

    /**
     * @return array|string
     * @throws GuzzleException
     */
    public function getHostingPlanById(int $id)
    {
        return $this->KeyHelpAPI->get('hosting-plans/' . $id);
    }

    /**
     * @return array|string
     * @throws GuzzleException
     */
    public function getHostingPlanByName(string $name)
    {
        return $this->KeyHelpAPI->get('hosting-plans/name/' . $name);
    }

    /**
     * @return array|string
     * @throws GuzzleException
     */
    public function createHostingPlan(string $name, int $diskSpace, int $traffic, int $domains, int $subDomains, int $emailAccounts, int $emailAddresses, int $databases, int $ftpUsers, int $scheduledTasks, bool $ftp, bool $php, bool $perl, bool $ssh, bool $backup, bool $panelAccess, bool $domainSecurity, bool $certificateManagement, bool $fileManager, bool $dnsEditor, bool $databaseRemoteAccess, bool $changePersonalData, bool $emailCatChall, bool $applications, bool $sshJail
    )
    {
        return $this->KeyHelpAPI->post('hosting-plans', [
            "name" => $name,
            "resources" => [
                "disk_space" => $diskSpace,
                "traffic" => $traffic,
                "domains" => $domains,
                "subdomains" => $subDomains,
                "email_accounts" => $emailAccounts,
                "email_addresses" => $emailAddresses,
                "databases" => $databases,
                "ftp_users" => $ftpUsers,
                "scheduled_tasks" => $scheduledTasks
            ],
            "permissions" => [
                "ftp" => $ftp,
                "php" => $php,
                "perl" => $perl,
                "ssh" => $ssh,
                "backup" => $backup,
                "panel_access" => $panelAccess,
                "domain_security" => $domainSecurity,
                "certificate_management" => $certificateManagement,
                "file_manager" => $fileManager,
                "dns_editor" => $dnsEditor,
                "database_remote_access" => $databaseRemoteAccess,
                "change_personal_data" => $changePersonalData,
                "email_catchall" => $emailCatChall,
                "applications" => $applications,
                "ssh_jail" => $sshJail
            ],
            "php" => [
                "memory_limit" => "256M",
                "max_execution_time" => 60,
                "post_max_size" => "72M",
                "upload_max_filesize" => "64M",
                "open_basedir" => "##DOCROOT##/www:##DOCROOT##/files:##DOCROOT##/tmp",
                "disable_functions" => "exec, system, shell_exec, passthru",
                "additional_settings" => "date.timezone = \"US/Central\""
            ],
            "php_fpm" => [
                "pm" => "ondemand",
                "max_children" => 3,
                "max_requests" => 0,
                "min_spare_servers" => null,
                "max_spare_servers" => null,
                "status" => true,
                "status_ip_restriction" => "192.168.178.1"
            ]
        ]);
    }



/*    public function updateHostingPlan(int $id) //TODO
    {
        return $this->KeyHelpAPI->get('hosting-plans/' . $id);
    }*/

    /**
     * @return array|string
     * @throws GuzzleException
     */
    public function deleteHostingPlan(int $id)
    {
        return $this->KeyHelpAPI->delete('hosting-plans/' . $id);
    }
}