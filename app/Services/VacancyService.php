<?php

namespace App\Services;

use App\Repositories\VacancyRepository;
use Exception;
use Illuminate\Http\Response;

class VacancyService
{
    const CLT = 'clt';

    const ESTAGIO = 'estagio';

    public function __construct(
        protected VacancyRepository $repository,
        protected CompanyService $companyService,
    ) {  
    }

    public function index()
    {
        return $this->repository->index();
    }

    public function show(int $id)
    {
        $vacancy = $this->repository->show($id);

        if (empty($vacancy)) {
            throw new Exception('Vaga não existe!', Response::HTTP_NOT_FOUND);
        }

        return $vacancy;
    }

    public function create(array $data)
    {
        $this->isMandatoryFieldsCltAndInternshipCompleted($data);
        $this->isAdequateWageClt($data);
        $this->isWorkloadAdequateIntern($data);
        $this->doesLimitVacanciesCompanyRegistered($data);

        return $this->repository->create([
            'title' => $data['title'],
            'description' => $data['description'],
            'type' => $data['type'],
            'wage' => $data['wage'],
            'hours' => $data['hours'],
            'id_company' => $data['id_company'],
        ]);
    }

    public function update(array $data, int $id)
    {
        $this->isAdequateWageClt($data);
        $this->isWorkloadAdequateIntern($data);

        $vacancy = $this->show($id);
        $vacancy->title = $data['title'];
        $vacancy->description = $data['description'];
        $vacancy->wage = $data['wage'];
        $vacancy->hours = $data['hours'];

        $this->repository->update($vacancy);
    }

    public function delete(int $id)
    {
        $vacancy = $this->show($id);

        return $this->repository->delete($vacancy);
    }

    public function getVacanciesByCompany(int $idCompany)
    {
        $vacancies = $this->repository->getVacanciesByCompany($idCompany);

        if ($vacancies->isEmpty()) {
            throw new Exception('Nenhum resultado foi encontrado!', Response::HTTP_OK);
        }

        return $vacancies;
    }

    private function isMandatoryFieldsCltAndInternshipCompleted(array $data)
    {
        if (
            in_array($data['type'], [VacancyService::CLT, VacancyService::ESTAGIO]) 
            && (empty($data['hours']) || empty($data['wage']))
        ) {
            throw new Exception(
                'Os campos de carga horária e salário são obrigatórios para esse tipo de vaga.', 
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }
    }

    private function isAdequateWageClt(array $data)
    {
        if ($data['type'] === VacancyService::CLT && $data['wage'] < config('vacancy.wage.min_clt')) {
            throw new Exception(
                'A remuneração mínima para modalidade CLT é de R$' . config('vacancy.wage.min_clt') . '.', 
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }
    }

    private function isWorkloadAdequateIntern(array $data)
    {
        if (
            $data['type'] === VacancyService::ESTAGIO
            && $data['hours'] > config('vacancy.workload.estagio.max_hour')
        ) {
            throw new Exception(
                'Carga horária inadequada para estagiarios. A carga horária deve ser de até ' 
                . config('vacancy.workload.estagio.max_hour') . ' horas.',
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }
    }

    private function doesLimitVacanciesCompanyRegistered(array $data)
    {
        $company = $this->companyService->show($data['id_company']);

        $numberVacanciesRegistered = $this->repository->getNumberVacanciesByCompany($company->id);

        if ($numberVacanciesRegistered >= $company->plan->first()['number_vacancies']) {
            throw new Exception('Número de vagas para o plano atual excedido.', Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }
}