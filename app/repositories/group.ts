import { PrismaClient, Group } from "@prisma/client";

export class GroupRepository {
    private prisma: PrismaClient;

    constructor(prismaClient: PrismaClient){
        this.prisma = prismaClient;
    }

    async createGroup(masterId: number, groupName: string): Promise<Group | boolean>{
        return this.prisma.group.create({
            data: {
                created_at: new Date(),
                name: groupName,
                master: {
                    connect: {id: masterId}
                }
            }
        });
    }

    async updateGroup(id: number, newName: string, newModerator: number | null): Promise<Group | null>{
        //An update may or may not have a moderator
        return this.prisma.group.update({
            where: {id},
            data: {
                name: newName,
                ...(newModerator ? { moderator: { connect: {id: newModerator} } } : {})
            }
        });
    }

    async deleteGroup(id: number): Promise<Group>{
        return this.prisma.group.delete({
            where: {id}
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
}