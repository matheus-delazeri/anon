import { PrismaClient, Group } from "@prisma/client";

export class GroupRepository {
    private prisma: PrismaClient;

    constructor(prisma: PrismaClient){
        this.prisma = prisma;
    }

    //Search
    async exists(id: number): Promise<boolean>{
        const group = await this.prisma.group.findUnique({
            where: {id}
        });

        return !!group;
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

    //Manipulation
    async createGroup(groupName: string): Promise<Group>{
        return this.prisma.group.create({
            data: {
                created_at: new Date(),
                name: groupName
            }
        });
    }

    async updateGroup(id: number, newGroupName: string): Promise<Group | null>{
        return this.prisma.group.update({
            where: {id},
            data: {
                name: newGroupName,
            }
        });
    }

    async deleteGroup(id: number): Promise<boolean>{
        return !!(this.prisma.group.delete({
            where: {id}
        }))
    }
}