import {PrismaClient, User} from '@prisma/client';

export class UserRepository {
    private prisma: PrismaClient;

    constructor(prismaClient: PrismaClient) {
        this.prisma = prismaClient;
    }

    async createUser(hash: string): Promise<User | boolean> {
        return this.prisma.user.create({
            data: {
                created_at: new Date(),
                hash: hash
            }
        });
    }

    async getUserById(id: number): Promise<User | null> {
        return this.prisma.user.findUnique({
            where: {id},
        });
    }

    async getUserByHash(hash: string): Promise<User | null> {
        return this.prisma.user.findUnique({
            where: {hash: hash},
        });
    }

    async deleteUser(id: number): Promise<User> {
        return this.prisma.user.delete({
            where: {id},
        });
    }
}
