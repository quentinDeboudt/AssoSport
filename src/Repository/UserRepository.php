<?php

namespace App\Repository;

use App\Entity\Lesson;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;
use function MongoDB\BSON\toJSON;
use function Symfony\Component\String\u;

/**
 * @extends ServiceEntityRepository<User>
 *
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository implements PasswordUpgraderInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function save(User $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(User $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     */
    public function upgradePassword(PasswordAuthenticatedUserInterface $user, string $newHashedPassword): void
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', \get_class($user)));
        }

        $user->setPassword($newHashedPassword);

        $this->save($user, true);
    }


    public function findUserLesson(): array
    {
        // Realisation de la requete
        $queryBuilder = $this->createQueryBuilder('u');
        $queryBuilder->addSelect('l.id','sp.name', 'l.nb_place', 'c.name' , 'lo.name');

        // Jointures
        $queryBuilder->leftJoin('lesson_user', 'lu', 'ON', 'u.id = lu.user_id');
        $queryBuilder->leftJoin(`lesson` , 'l', 'ON', 'l.id = lu.lesson_id');
        $queryBuilder->leftJoin(`coach` , 'c', 'ON', 'c.id = l.coach_id');
        $queryBuilder->leftJoin(`location` , 'lo', 'ON', 'lo.id = l.location_id');
        $queryBuilder->leftJoin(`sport` , 'sp', 'ON', 'sp.id = l.id');
        $queryBuilder->addSelect('s', 'p', 'o', 'pl', 'c');
        $queryBuilder->where('u.id = ?19');
        //$queryBuilder->where('u = ?21');

        //Récuperation des données en BDD suite à la requête
        $query = $queryBuilder->getQuery();

        return $query->getResult();
    }
}
