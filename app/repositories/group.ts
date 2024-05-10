import { PrismaClient, Group } from "@prisma/client";
import { UserRepository } from "./user";

export class GroupRepository {
    private prisma: PrismaClient;

    constructor(prismaClient: PrismaClient){
        this.prisma = prismaClient;
    }

    async createGroup(masterId: number, groupName: string): Promise<Group | boolean>{
        const userRepository = new UserRepository(this.prisma);
        const master = await userRepository.getUserById(masterId);

        if(!master){
            throw new Error("Group master not found!")
        }

        return this.prisma.group.create({
            data: {
                created_at: new Date(),
                name: groupName,
                master: {
                    connect: {id: master.id}
                }
            }
        });
    }

    async renameGroup(id: number, newName: string): Promise<Group | null>{
        return this.prisma.group.update({
            where: {id},
            data: {name: newName}
        })
    }

    async getGroupById(id: number): Promise<Group | null>{
        return this.prisma.group.findUnique({
            where: {id}
        });
    }

    async getGroupByName(name: string): Promise<Group[] | null>{
        return this.prisma.group.findMany({
            where: {name: name}
        })
    }

    async deleteGroup(id: number): Promise<Group>{
        return this.prisma.group.delete({
            where: {id}
        })
    }
}